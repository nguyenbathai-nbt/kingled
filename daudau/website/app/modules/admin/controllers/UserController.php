<?php

namespace Daudau\Modules\Admin\Controllers;

use Daudau\Common\Models\Bookmark\Category;
use Daudau\Common\Models\Bookmark\CategoryType;
use Daudau\Common\Models\Recipe\Image;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Models\Users\Users;
use Daudau\Common\Models\Users\UsersCategory;
use Daudau\Modules\Admin\Forms\UserForm;
use Phalcon\Tag;

class UserController extends BaseDashboardController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function listUserAction()
    {
        $this->view->activemenu = [
            'user',
            'user_list'
        ];
        $this->view->names = [
            [
                'label' => 'Danh sách người dùng',
                'href' => '/admin/user/listUser'
            ],
        ];
        $current_page = $this->request->getQuery('page', 'int', 1);
        $limit_of_page = 10;
        //  $form = new SearchCustomerForm();
        // $this->view->form = $form;
        $cond_array = [];
        $param_url = $this->request->getQuery();
        $bind_data = [];
        foreach ($param_url as $key => $value) {
            Tag::setDefault($key, $value);
            if ($key != '_url' && $key != 'page' && $value != '') {
                if ($key == 'active' && $value != '') {
                    $value = trim($value);
                    array_push($cond_array, "$key =:$key:");
                    $bind_data[$key] = $value;
                } else if ($key == 'active' && $value == '') {
                    array_push($cond_array, "active='1'");
                } else {
                    $value = trim($value);
                    array_push($cond_array, "$key =:$key:");
                    $bind_data[$key] = $value;
                }
            }
        }
        if (count($cond_array) == 0) {
            array_push($cond_array, "status_id !='0'");
        }
        $conditions = implode(' AND ', $cond_array);
        $user = Users::find([
            'conditions' => $conditions,
            'bind' => $bind_data,
            'limit' => $limit_of_page,
            'offset' => (($current_page - 1) * $limit_of_page),
        ]);
        $user_total_record = Users::count([
            'conditions' => $conditions,
            'bind' => $bind_data
        ]);
        if (count($user) == 0) {
            $this->view->user = null;
        } else {
            $this->view->user = $user;
        }
        $this->view->paging = $this->helper->util()->paging($user_total_record, $this->request->getQuery(), $limit_of_page, $current_page);

    }

    public function deleteUserAction($id)
    {
        $this->view->disable();
        $status_id_disable = Status::getStatusIdByCode('disable');
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if (!$user) {
            $this->flashSession->error($this->helper->translate("Không tìm thấy người dùng"));
            $this->redirect('/admin/user/listUser');
        } else {
            $user->setStatusId($status_id_disable);
            $user->save();
            $this->flashSession->success($this->helper->translate("Xóa thành công"));
            $this->redirect('/admin/user/listUser');
        }
    }

    public function editUserAction($id)
    {
        $this->view->activemenu = [
            'user',
            'user_list'
        ];
        $this->view->names = [
            [
                'label' => 'Chỉnh sửa người dùng',
                'href' => '/admin/user/listUser'
            ],
        ];
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        $form = new UserForm();
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $form->edit();
        if ($this->request->isPost()) {
            $post = $this->request->getPost();

            if ($post['email'] != $user->getEmail() || $post['username'] != $user->getUsername()) {
                if ($post['email'] != $user->getEmail()) {
                    $check = Users::findFirst([
                        'conditions' => 'email=:email:',
                        'bind' => [
                            'email' => $post['email']
                        ]
                    ]);
                    if ($check) {
                        $this->flashSession->error('Email đã tồn tại');
                        return  $this->redirect('/admin/user/listUser');

                    }
                }
                if ($post['username'] != $user->getUsername()) {
                    $check = Users::findFirst([
                        'conditions' => 'username=:username:',
                        'bind' => [
                            'username' => $post['username']
                        ]
                    ]);
                    if ($check) {
                        $this->flashSession->error('Tài khoản đăng nhập đã tồn tại');
                        return $this->redirect('/admin/user/listUser');

                    }
                }

            } else if ($post['email'] != $user->getEmail() && $post['username'] != $user->getUsername()) {
                $form->bind($post, $user);
                $error = Users::checkValidations($post, $user);
                if (count($error) != 0) {
                    foreach ($error as $er) {
                        $this->flashSession->error($er);
                        $this->redirect('/admin/user/listUser');
                    }
                }
            }
            $form->bind($post, $user);
            $user_category_old = UsersCategory::find([
                'conditions' => 'user_id=:user_id:',
                'bind' => [
                    'user_id' => $user->getId()
                ]
            ]);
            foreach ($user_category_old as $item) {
                $item->setStatusId($status_id_disable);
                $item->save();
            }
            foreach ($post['category'] as $index => $item) {
                $user_category = UsersCategory::findFirst([
                    'conditions' => 'user_id=:user_id: and category_id=:category_id: and status_id=:status_id:',
                    'bind' => [
                        'user_id' => $user->getId(),
                        'category_id' => $item,
                        'status_id' => $status_id_disable
                    ]
                ]);
                if (!$user_category) {
                    $user_category = new UsersCategory();
                    $user_category->setId($user_category->getSequenceId());
                    $user_category->setUserId($user->getId());
                    $user_category->setCategoryId($item);
                    $user_category->setStatusId($status_id_enable);
                    $user_category->save();
                } else {
                    $user_category->setStatusId($status_id_enable);
                    $user_category->save();
                }
            }

            if ($user->save()) {
                $this->flashSession->success($this->helper->translate('Chỉnh sửa thông tin thành công'));
                return $this->redirect('/admin/user/listUser');
            } else {
                foreach ($user->getMessages() as $message) {
                    $this->flashSession->error($this->helper->tranlate($message->getMessage()));
                }
                $form->setEntity($post);
            }
        } else {
            $form->setEntity($user);
            $list_category_type = CategoryType::find();
            $list_category = [];
            foreach ($list_category_type as $item) {
                $list_category_by_category_type = Category::find([
                    'conditions' => 'type_id=:type_id:',
                    'bind' => [
                        'type_id' => $item->getId()
                    ]
                ]);
                $list_category[$item->getName()] = $list_category_by_category_type;
            }
            $list_user_category = UsersCategory::find([
                'conditions' => 'user_id=:user_id: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $list_id_user_category = [];
            foreach ($list_user_category as $item) {
                $list_id_user_category[] = $item->getCategoryId();
            }
            $this->view->list_id_user_category = $list_id_user_category;
            $this->view->list_category_type = $list_category_type;
            $this->view->list_category = $list_category;
            $this->view->user = $user;


        }
        $this->view->form = $form;

    }

    public function viewuserAction($id)
    {
        $this->view->activemenu = [
            'user',
            'user_list'
        ];
        $this->view->names = [
            [
                'label' => 'Xem thông tin người dùng',
                'href' => '/admin/user/viewUser'
            ],
        ];
        $form = new UserForm();
        $form->view();
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($user) {
            $form->setEntity($user);
            $list_category_type = CategoryType::find();
            $list_category = [];
            foreach ($list_category_type as $item) {
                $list_category_by_category_type = Category::find([
                    'conditions' => 'type_id=:type_id:',
                    'bind' => [
                        'type_id' => $item->getId()
                    ]
                ]);
                $list_category[$item->getName()] = $list_category_by_category_type;
            }
            $list_user_category = UsersCategory::find([
                'conditions' => 'user_id=:user_id: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $list_id_user_category = [];
            foreach ($list_user_category as $item) {
                $list_id_user_category[] = $item->getCategoryId();
            }
            $this->view->list_id_user_category = $list_id_user_category;
            $this->view->list_category_type = $list_category_type;
            $this->view->list_category = $list_category;
            $this->view->user = $user;
        } else {

            $this->flashSession->warning($this->helper->translate("Không tìm thấy người dùng"));
        }
        $this->view->form = $form;
    }

    public function createUserAction()
    {
        $this->view->activemenu = [
            'user',
            'user_create'
        ];
        $this->view->names = [
            [
                'label' => 'Tạo người dùng',
                'href' => '/admin/user/createUser'
            ],
        ];
        $status_id_enable = Status::getStatusIdByCode('enable');
        $form = new UserForm();
        $user = new Users();
        $form->create();
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $user);
            $user->setId($user->getSequenceId());
            $user->setPassword('1');
            $token = openssl_random_pseudo_bytes(16);
            $token = bin2hex($token);
            $user->setToken($token);
            $image = new Image();
            $image->setId($image->getSequenceId());
            $image->setCode($image->setCode('AVATAR-USER-' . $user->getId()));
            $image->setImageBase('data:image/png;base64,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');
            $image->setImageUrl("/public/account.png");
            // $image->setImageUrlResize("/public/image-upload-resize/" . $_FILES['imageUpload']['name']);
            $user->setImageId($image->getId());
            $image->setStatusId($status_id_enable);
            $image->save();
            $error = Users::checkValidations($post);
            if (count($error) != 0) {
                foreach ($error as $er) {
                    $this->flashSession->error($this->helper->tranlate($er));
                }
            } else {
                if ($user->save()) {
                    $this->flashSession->success($this->helper->translate('Tạo người dùng thành công'));
                    return $this->redirect('/admin/user/listUser');
                } else {
                    foreach ($user->getMessages() as $message) {
                        $this->flashSession->error($this->helper->tranlate($message->getMessage()));
                    }
                    $form->setEntity($post);
                }
            }

        } else {
            $form->setEntity($user);
        }
        $this->view->form = $form;
    }

}

