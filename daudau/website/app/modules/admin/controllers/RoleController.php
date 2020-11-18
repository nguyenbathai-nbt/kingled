<?php

namespace Daudau\Modules\Admin\Controllers;

use Daudau\Common\Models\Users\Role;
use Daudau\Common\Models\Users\Status;
use Daudau\Modules\Admin\Forms\RoleForm;
use Phalcon\Tag;

class RoleController extends BaseDashboardController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function listRoleAction()
    {
        $this->view->activemenu = [
            'user',
            'role_list'
        ];
        $this->view->names = [
            [
                'label' => 'Danh sách quyền',
                'href' => '/admin/role/listRole'
            ],
        ];
        $status_id_enable = Status::getStatusIdByCode('enable');
        $current_page = $this->request->getQuery('page', 'int', 1);
        $limit_of_page = 10;
        $form = new RoleForm();
        $form->search();
        $this->view->form = $form;
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
        array_push($cond_array, "status_id ='" . $status_id_enable . "'");

        $conditions = implode(' AND ', $cond_array);
        $role = Role::find([
            'conditions' => $conditions,
            'limit' => $limit_of_page,
            'offset' => (($current_page - 1) * $limit_of_page),
        ]);
        $role_total_record = Role::count([
            'conditions' => $conditions,
            'bind' => $bind_data
        ]);
        if (count($role) == 0) {
            $this->view->role = null;
        } else {
            $this->view->role = $role;
        }
        $this->view->paging = $this->helper->util()->paging($role_total_record, $this->request->getQuery(), $limit_of_page, $current_page);

    }

    public function createRoleAction()
    {
        $this->view->activemenu = [
        ];
        $this->view->names = [
            [
                'label' => 'Tạo quyền',
                'href' => '/admin/role/createRole'
            ],
        ];
        $status_id_enable = Status::getStatusIdByCode('enable');

        $role = new Role();
        $form = new RoleForm();
        $form->create();
        $this->view->form = $form;
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $check_exist_role = Role::findFirst([
                'conditions' => 'name=:name: and code=:code:',
                'bind' => [
                    'name' => $post['name'],
                    'code' => $post['code']
                ]
            ]);
            if ($check_exist_role) {
                $check_exist_role->setStatusId($status_id_enable);
                $check_exist_role->save();
                $this->flashSession->success($this->helper->translate('Tạo quyền thành công'));
                return $this->redirect('/admin/role/listRole');
            } else {
                $role->setId($role->getSequenceId());
                $form->bind($post, $role);
                $role->setStatusId($status_id_enable);
                $error = Role::checkValidations($post);
                if (count($error) != 0) {
                    foreach ($error as $er) {
                        $this->flashSession->error($this->helper->translate($er));
                    }
                } else {
                    if ($role->save()) {
                        $this->flashSession->success($this->helper->translate('Tạo quyền thành công'));
                        return $this->redirect('/admin/role/listRole');
                    } else {
                        foreach ($role->getMessages() as $message) {
                            $this->flashSession->error($this->helper->translate($message->getMessage()));
                        }
                        $form->setEntity($post);
                    }
                }
            }

        }
    }

    public function deleteRoleAction($id)
    {
        $this->view->disable();
        $status_id_disable = Status::getStatusIdByCode('disable');

        $role = Role::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($role) {
            $role->setStatusId($status_id_disable);
            $this->flashSession->success($this->helper->translate('Xóa thành công'));
            $role->save();
        } else {
            $this->flashSession->warning($this->helper->translate('Không tìm thấy quyền'));
        }
        return $this->redirect('/admin/role/listRole');
    }

    public function editRoleAction($id)
    {
        $this->view->activemenu = [
            'user',
            'role_list'
        ];
        $this->view->names = [
            [
                'label' => 'Chỉnh sửa quyền',
                'href' => '/admin/role/listRole'
            ],
        ];
        $form = new RoleForm();
        $form->edit();

        $role = Role::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            if($post['name'] != $role->getName())
            {
                $check=Role::findFirst([
                    'conditions'=>'name=:name:',
                    'bind'=>[
                        'name'=>$post['name']
                    ]
                ]);
                if($check)
                {
                    $this->flashSession->error('Tên quyền đã tồn tại');
                    return $this->redirect('/admin/role/listRole');
                }
            }
            if($post['code'] != $role->getCode())
            {
                $check=Role::findFirst([
                    'conditions'=>'code=:code:',
                    'bind'=>[
                        'code'=>$post['code']
                    ]
                ]);
                if($check)
                {
                    $this->flashSession->error('Mã số quyền đã tồn tại');
                    return $this->redirect('/admin/role/listRole');
                }
            }
            $form->bind($post, $role);
            if ($role->save()) {
                $this->flashSession->success($this->helper->translate('Chỉnh sửa quyền thành công'));
                return $this->redirect('/admin/role/listRole');
            } else {
                foreach ($role->getMessages() as $message) {
                    $this->flashSession->error($this->helper->tranlate($message->getMessage()));
                }
            }
        } else {
            $form->setEntity($role);
        }

        $this->view->form = $form;
    }

    public function viewRoleAction($id)
    {
        $this->view->activemenu = [
            'user',
            'role_list'
        ];
        $this->view->names = [
            [
                'label' => 'Xem thông tin quyền',
                'href' => '/admin/role/listRole'
            ],
        ];
        $form = new RoleForm();
        $form->view();

        $role = Role::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        $form->setEntity($role);
        $this->view->form = $form;
    }

}

