<?php

namespace Daudau\Modules\Account\Controllers;

use Daudau\Common\Models\Bookmark\Bookmark;
use Daudau\Common\Models\Bookmark\BookmarkUser;
use Daudau\Common\Models\Recipe\Image;
use Daudau\Common\Models\Recipe\Recipecategory;
use Daudau\Common\Models\Recipe\RecipeCook;
use Daudau\Common\Models\Recipe\RecipeMaterial;
use Daudau\Common\Models\Recipe\SeenRecipe;
use Daudau\Common\Models\Recipe\Step;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Models\Users\Users;
use Daudau\Common\Mvc\Controller;

class IndexController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        $this->view->stylesheetsother = [
            "/public/css/account.css",
        ];
        $this->view->scriptsother = [

        ];
    }

    public function indexAction()
    {
        $slug = $this->dispatcher->getParam('slug');
        $recipe_cook = RecipeCook::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => $slug
            ]
        ]);
        $list_recipe_material = RecipeMaterial::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $recipe_cook->getId()
            ]
        ]);
        $list_step = Step::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $recipe_cook->getId()
            ]
        ]);
        $list_category = Recipecategory::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $recipe_cook->getId()
            ]
        ]);

        $this->view->recipe_cook = $recipe_cook;
        $this->view->list_step = $list_step;
        $this->view->list_category = $list_category;
        $this->view->list_recipe_material = $list_recipe_material;
    }

    public function contactAction()
    {

    }

    public function recipeAction()
    {
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $status_id_confirm = Status::getStatusIdByCode('confirm');
        $status_id_reject = Status::getStatusIdByCode('reject');
        $list_recipe_approved = RecipeCook::find([
            'conditions' => 'status_id=:status_id:',
            'bind' => [
                'status_id' => $status_id_enable
            ],
            'order'=>'created_time DESC'
        ]);
        $list_recipe_confirm = RecipeCook::find([
            'conditions' => 'status_id=:status_id:',
            'bind' => [
                'status_id' => $status_id_confirm
            ],
            'order'=>'created_time DESC'
        ]);
        $list_recipe_reject = RecipeCook::find([
            'conditions' => 'status_id=:status_id:',
            'bind' => [
                'status_id' => $status_id_reject
            ],
            'order'=>'created_time DESC'
        ]);
        $list_recipe_all = RecipeCook::find([
        ]);

        $this->view->list_recipe_approved = $list_recipe_approved;
        $this->view->list_recipe_confirm = $list_recipe_confirm;
        $this->view->list_recipe_reject = $list_recipe_reject;
        $this->view->list_recipe_all = $list_recipe_all;

    }

    public function recipeSeenAction()
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $auth_site_home['id']
            ]
        ]);
        if (!$user) {
            $this->view->find_user = 'false';
        } else {
            $this->view->find_user = 'true';
            if ($user->getId() == $auth_site_home['id']) {
                $this->view->btn_bookmark = 'fasle';
            } else {
                $this->view->btn_bookmark = 'true';
            }

            $recipe_seen = SeenRecipe::find([
                'conditions' => 'user_id=:user_id:',
                'bind' => [
                    'user_id' => $user->getId()
                ]
            ]);
            $total_recipe_seen = count($recipe_seen);
            foreach ($recipe_seen as $item) {
                if ($item->recipe->getStatusId() != $status_id_enable) {
                    $total_recipe_seen--;
                }
            }

            $this->view->auth_site_home = $auth_site_home;
            $this->view->user = $user;
            $this->view->total_recipe_seen = $total_recipe_seen;
            $this->view->recipe_seen = $recipe_seen;
            $this->view->status_id_enable = $status_id_enable;
        }
    }

    public function recipeFavouriteAction()
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $auth_site_home['id']
            ]
        ]);
        if (!$user) {
            $this->view->find_user = 'false';
        } else {
            $this->view->find_user = 'true';
            if ($user->getId() == $auth_site_home['id']) {
                $this->view->btn_bookmark = 'fasle';
            } else {
                $this->view->btn_bookmark = 'true';
            }

            $recipe_favourite = Bookmark::find([
                'conditions' => 'user_id=:user_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
                'bind' => [
                    'user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'bookmark_type' => 'favourite'
                ]
            ]);
            $total_recipe_favourite = count($recipe_favourite);
            foreach ($recipe_favourite as $item) {
                if ($item->recipe_cook->getStatusId() != $status_id_enable) {
                    $total_recipe_favourite--;
                }
            }
            $this->view->auth_site_home = $auth_site_home;
            $this->view->user = $user;
            $this->view->total_recipe_favourite = $total_recipe_favourite;
            $this->view->recipe_favourite = $recipe_favourite;
            $this->view->status_id_enable = $status_id_enable;
        }
    }

    public function recipeBookmarkAction()
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $auth_site_home['id']
            ]
        ]);
        if (!$user) {
            $this->view->find_user = 'false';
        } else {
            $this->view->find_user = 'true';
            if ($user->getId() == $auth_site_home['id']) {
                $this->view->btn_bookmark = 'fasle';
            } else {
                $this->view->btn_bookmark = 'true';
            }

            $recipe_favourite = Bookmark::find([
                'conditions' => 'user_id=:user_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
                'bind' => [
                    'user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'bookmark_type' => 'bookmark'
                ]
            ]);
            $total_recipe_favourite = count($recipe_favourite);
            foreach ($recipe_favourite as $item) {
                if ($item->recipe_cook->getStatusId() != $status_id_enable) {
                    $total_recipe_favourite--;
                }
            }
            $this->view->auth_site_home = $auth_site_home;
            $this->view->user = $user;
            $this->view->total_recipe_favourite = $total_recipe_favourite;
            $this->view->recipe_favourite = $recipe_favourite;
            $this->view->status_id_enable = $status_id_enable;
        }
    }

    public function infoAction()
    {
        $auth_site_home = $this->auth->getAuthSiteHome();
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $auth_site_home['id']
            ]
        ]);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $user->setUserName($post['username']);
            $user->setEmail($post['email']);
            $user->setPhone($post['phone']);
            $user->save();
            $this->redirect('/tai-khoan/thong-tin');
        } else {
            $this->view->username = $user->getUserName();
            $this->view->email = $user->getEmail();
            $this->view->phone = $user->getPhone();
        }

        $this->view->user = $user;

    }

    public function changePasswordAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $auth_site_home = $this->auth->getAuthSiteHome();
            $user = Users::findFirst([
                'conditions' => 'id=:id:',
                'bind' => [
                    'id' => $auth_site_home['id']
                ]
            ]);
            $list = [];
            if ($user == false) {

                $this->flashSession->error('Tài khoản hoặc mật khẩu không đúng. Vui lòng thử lạidsdsdsd!');
            } else if (!$this->security->checkHash($post['old_password'], $user->getPassword())) {

                $this->flashSession->error('Tài khoản hoặc mật khẩu không đúng. Vui lòng thử lại!');
            } else {
                if ($post['new_password'] != $post['confirm_password']) {
                    $this->flashSession->warning('Mật khẩu xác nhận không khớp.');
                } else {
                    $user->setPassword($this->getDI()
                        ->getSecurity()
                        ->hash($post['new_password']));
                    $user->save();
                    $this->flashSession->success('Đổi mật khẩu thành công');
                }

            }
            $this->redirect('/tai-khoan/doi-mat-khau');
        }
    }

    public function searchUserAction()
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $search_user_text = '';
        if ($this->request->isPost()) {
            $search_user_code = $this->request->getPost('searchuser');
            $search_user_text = $search_user_code;
            if ($search_user_code == "" || $search_user_code == null || empty($search_user_code)) {
                $user = Users::find();
                $this->view->search_user = $user;
                $this->view->search_user_text = $search_user_text;
            } else {
                $user = Users::find([
                    'conditions' => 'username LIKE :username: and id !=:id: ',
                    'bind' => [
                        'username' => '%' . $search_user_code . '%',
                        'id' => $auth_site_home['id']
                    ]
                ]);
                $this->view->search_user = $user;
                $this->view->search_user_text = $search_user_text;
            }

        } else {
            $user = Users::find();
            $this->view->search_user = $user;
            $this->view->search_user_text = $search_user_text;

        }
    }

    public function deleteRecipeAction($id)
    {
        $this->view->disable();
        $this->db->begin();
        $status_id_disable = Status::getStatusIdByCode('disable');
        $recipe = RecipeCook::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        $recipe->setStatusId($status_id_disable);
        $recipe->save();
        $recipe_material = RecipeMaterial::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $id
            ]
        ]);
        foreach ($recipe_material as $item) {
            $item->setStatusId($status_id_disable);
            $item->save();
        }
        $step = Step::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $id
            ]
        ]);
        foreach ($step as $item) {
            $item->setStatusId($status_id_disable);
            $item->save();
        }
        $recipe_category = RecipeCategory::find([
            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $id
            ]
        ]);
        foreach ($recipe_category as $item) {
            $item->setStatusId($status_id_disable);
            $item->save();
        }
        $this->db->commit();
        $this->redirect('/tai-khoan/cong-thuc');
    }

    public function ajaxUploadAvatarAction()
    {
        $this->view->disable();
        $status_id_enable = Status::getStatusIdByCode('enable');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $post = $this->request->getPost();
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $auth_site_home['id']
            ]
        ]);
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $image_type = $finfo->file($_FILES['imageUpload']['tmp_name']);
        if (($image_type == "image/png" || $image_type == "image/svg+xml" || $image_type == "image/svg" || $image_type == "image/jpeg")) {
            if ($_FILES['imageUpload']['size'] <= 1048576) {
                move_uploaded_file($_FILES['imageUpload']['tmp_name'], BASE_PATH . "/public/image-upload/" . $_FILES['imageUpload']['name']);
                $image_base = base64_encode(file_get_contents(BASE_PATH . "/public/image-upload/" . $_FILES['imageUpload']['name']));
                $img = $this->helper->resize_image(BASE_PATH . "/public/image-upload/" . $_FILES['imageUpload']['name'], 300, 300, $image_type);
                if ($image_type == "image/png") {
                    imagepng($img, BASE_PATH . "/public/image-upload-resize/" . $_FILES['imageUpload']['name']);
                } else {
                    imagejpeg($img, BASE_PATH . "/public/image-upload-resize/" . 'demo1.jpg');
                }

                if ($user->getImageId() == null || $user->getImageId() == "null" || empty($user->getImageId())) {
                    $image = new Image();
                    $image->setId($image->getSequenceId());
                    $image->setCode('AVATAR-USER-' . $user->getId());
                    $image->setImageBase('data:' . image_type . ';base64,' . $image_base);
                    $image->setImageUrl("/public/image-upload/" . $_FILES['imageUpload']['name']);
                    $image->setImageUrlResize("/public/image-upload-resize/" . $_FILES['imageUpload']['name']);
                    $image->setStatusId($status_id_enable);
                    $user->setImageId($image->getId());
                    $user->save();
                    $image->save();
                    die();
                } else {
                    $image = Image::findFirst([
                        'conditions' => 'id=:id:',
                        'bind' => [
                            'id' => $user->getImageId()
                        ]
                    ]);
                    $image->setImageBase('data:' . image_type . ';base64,' . $image_base);
                    $image->setImageUrl("/public/image-upload/" . $_FILES['imageUpload']['name']);
                    $image->setStatusId($status_id_enable);
                    $image->save();
                }
            } else {
                $this->flashSession->error("Kích thước ảnh vướt quá giới hạn cho phép.");
            }
        } else {
            $this->flashSession->error("The import file is not in the correct format .png and .svg");
        }
        $this->redirect('/tai-khoan/thong-tin');
    }

    public function memberAction($username)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $user = Users::findFirst([
            'conditions' => 'username=:username:',
            'bind' => [
                'username' => $username
            ]
        ]);
        if (!$user) {
            $this->view->find_user = 'false';
        } else {
            $this->view->find_user = 'true';
            if ($user->getId() == $auth_site_home['id']) {
                $this->view->btn_bookmark = 'fasle';
            } else {
                $this->view->btn_bookmark = 'true';
            }
            $total_seen = SeenRecipe::count([
                'conditions' => 'user_id=:user_id:',
                'bind' => [
                    'user_id' => $user->getId()
                ]
            ]);
            $total_recipe = RecipeCook::count([
                'conditions' => 'user_id=:user_id: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $recipe = RecipeCook::find([
                'conditions' => 'user_id=:user_id: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $list_bookmark_reipe = Bookmark::find([
                'conditions' => 'user_id=:user_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
                'bind' => [
                    'user_id' => $auth_site_home['id'],
                    'status_id' => $status_id_enable,
                    'bookmark_type' => 'favourite'
                ]
            ]);
            $list_bookmark = [];
            foreach ($recipe as $index => $item) {
                $list_bookmark[$item->getId()] = 'false';
                foreach ($list_bookmark_reipe as $index2 => $item2) {
                    if ($item->getId() == $item2->getRecipeCookId()) {
                        $list_bookmark[$item->getId()] = 'true';
                        break;
                    }
                }
            }
            $list_seen_recipe = [];
            foreach ($recipe as $item) {
                $count = SeenRecipe::count([
                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                    'bind' => [
                        'recipe_cook_id' => $item->getId()
                    ]
                ]);
                $list_seen_recipe[$item->getId()] = $count;
            }
            $bookmark_user = BookmarkUser::findFirst([
                'conditions' => 'user_id=:user_id: and bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'user_id' => $auth_site_home['id'],
                    'bookmark_user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'type' => 'bookmark_user'
                ]
            ]);
            $total_user_bookmark = BookmarkUser::count([
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'type' => 'bookmark_user'
                ]
            ]);
            $average_rate = BookmarkUser::average([
                'column' => 'point',
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'type' => 'rate'
                ]
            ]);
            if ($average_rate == null) {
                $this->view->average_rate = 0;
            } else {
                $this->view->average_rate = $average_rate;
            }

            $this->view->bookmark_user = $bookmark_user;
            $this->view->total_user_bookmark = $total_user_bookmark;
            $this->view->total_user_rate = count($average_rate);
            $this->view->list_bookmark = $list_bookmark;
            $this->view->auth_site_home = $auth_site_home;
            $this->view->list_seen_recipe = $list_seen_recipe;
            $this->view->user = $user;
            $this->view->total_seen = $total_seen;
            $this->view->total_recipe = $total_recipe;
            $this->view->recipe = $recipe;
        }
    }

    public function ajaxBookmarkUserAction()
    {
        $this->view->disable();
        $post = $this->request->getPost();
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $bookmark_user = BookmarkUser::findFirst([
            'conditions' => 'user_id=:user_id: and bookmark_user_id=:bookmark_user_id: and type=:type:',
            'bind' => [
                'user_id' => $post['user'],
                'bookmark_user_id' => $post['bookmark_user'],
                'type' => 'bookmark_user'
            ]
        ]);
        if ($bookmark_user) {
            if ($bookmark_user->getStatusId() == $status_id_disable) {
                $bookmark_user->setStatusId($status_id_enable);
                $bookmark_user->save();
                $total = BookmarkUser::count([
                    'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                    'bind' => [
                        'bookmark_user_id' => $post['bookmark_user'],
                        'status_id' => $status_id_enable,
                        'type' => 'bookmark_user'
                    ]
                ]);
                $demo =
                    [
                        'value' => 'Đã quan tâm',
                        'total' => $total,
                    ];
            } else {
                $bookmark_user->setStatusId($status_id_disable);
                $bookmark_user->save();
                $total = BookmarkUser::count([
                    'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                    'bind' => [
                        'bookmark_user_id' => $post['bookmark_user'],
                        'status_id' => $status_id_enable,
                        'type' => 'bookmark_user'
                    ]
                ]);
                $demo =
                    [
                        'value' => 'Quan tâm',
                        'total' => $total,
                    ];
            }
        } else {
            $bookmark_user = new BookmarkUser();
            $bookmark_user->setId($bookmark_user->getSequenceId());
            $bookmark_user->setUserId($post['user']);
            $bookmark_user->setBookmarkUserId($post['bookmark_user']);
            $bookmark_user->setStatusId($status_id_enable);
            $bookmark_user->setType('bookmark_user');
            $bookmark_user->save();
            $total = BookmarkUser::count([
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $post['bookmark_user'],
                    'status_id' => $status_id_enable,
                    'type' => 'bookmark_user'
                ]
            ]);
            $demo =
                [
                    'value' => 'Đã quan tâm',
                    'total' => $total,
                ];
        }
        echo json_encode($demo);
        die();
    }

    public function bookmarkUserAction($username)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $user = Users::findFirst([
            'conditions' => 'username=:username:',
            'bind' => [
                'username' => $username
            ]
        ]);
        if (!$user) {
            $this->view->find_user = 'false';
        } else {
            $this->view->find_user = 'true';
            if ($user->getId() == $auth_site_home['id']) {
                $this->view->btn_bookmark = 'fasle';
            } else {
                $this->view->btn_bookmark = 'true';
            }
            $total_seen = SeenRecipe::count([
                'conditions' => 'user_id=:user_id:',
                'bind' => [
                    'user_id' => $user->getId()
                ]
            ]);
            $total_recipe = RecipeCook::count([
                'conditions' => 'user_id=:user_id: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $recipe = RecipeCook::find([
                'conditions' => 'user_id=:user_id: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $user->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $list_seen_recipe = [];
            foreach ($recipe as $item) {
                $count = SeenRecipe::count([
                    'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                    'bind' => [
                        'recipe_cook_id' => $item->getId()
                    ]
                ]);
                $list_seen_recipe[$item->getId()] = $count;
            }
            $bookmark_user = BookmarkUser::findFirst([
                'conditions' => 'user_id=:user_id: and bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'user_id' => $auth_site_home['id'],
                    'bookmark_user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'type' => 'bookmark_user'
                ]
            ]);
            $list_user_bookmark = BookmarkUser::find([
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'type' => 'bookmark_user'
                ]
            ]);
            $list_bookmark_user = BookmarkUser::find([
                'conditions' => 'user_id=:user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'type' => 'bookmark_user'
                ]
            ]);
            $average_rate = BookmarkUser::average([
                'column' => 'point',
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'type' => 'rate'
                ]
            ]);
            if ($average_rate == null) {
                $this->view->average_rate = 0;
                $this->view->total_average_rate = 0;
            } else {
                $this->view->average_rate = $average_rate;
                $this->view->total_average_rate = BookmarkUser::count([
                    'column' => 'point',
                    'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                    'bind' => [
                        'bookmark_user_id' => $user->getId(),
                        'status_id' => $status_id_enable,
                        'type' => 'rate'
                    ]
                ]);
            }
            $this->view->bookmark_user = $bookmark_user;
            $this->view->total_user_rate = count($average_rate);
            $this->view->total_user_bookmark = count($list_user_bookmark);
            $this->view->list_user_bookmark = $list_user_bookmark;
            $this->view->total_bookmark_user = count($list_bookmark_user);
            $this->view->list_bookmark_user = $list_bookmark_user;
            $this->view->auth_site_home = $auth_site_home;
            $this->view->list_seen_recipe = $list_seen_recipe;
            $this->view->user = $user;
            $this->view->total_seen = $total_seen;
            $this->view->total_recipe = $total_recipe;
            $this->view->recipe = $recipe;
        }
    }
}

