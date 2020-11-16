<?php

namespace Daudau\Modules\Admin\Controllers;

use Daudau\Common\Models\Users\Role;
use Daudau\Common\Models\Users\Status;
use Daudau\Modules\Admin\Forms\StatusForm;
use Phalcon\Tag;

class StatusController extends BaseDashboardController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function listStatusAction()
    {
        $this->view->activemenu = [
            'user',
            'status_list'
        ];
        $this->view->names = [
            [
                'label' => 'Danh sách trạng thái',
                'href' => '/admin/role/listRole'
            ],
        ];
        $current_page = $this->request->getQuery('page', 'int', 1);
        $limit_of_page = 10;
        $form = new StatusForm();
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

        $conditions = implode(' AND ', $cond_array);
        $status = Status::find([
            'conditions' => $conditions,
            'bind' => $bind_data,
            'limit' => $limit_of_page,
            'offset' => (($current_page - 1) * $limit_of_page),
        ]);
        $status_total_record = Status::count([
            'conditions' => $conditions,
            'bind' => $bind_data
        ]);
        if (count($status) == 0) {
            $this->view->status = null;
        } else {
            $this->view->status = $status;
        }
        $this->view->paging = $this->helper->util()->paging($status_total_record, $this->request->getQuery(), $limit_of_page, $current_page);

    }

    public function createStatusAction()
    {
        $this->view->activemenu = [
            'user',
            'status_create'
        ];
        $this->view->names = [
            [
                'label' => 'Tạo trạng thái',
                'href' => '/admin/status/createStatus'
            ],
        ];
        $status = new Status();
        $form = new StatusForm();
        $form->create();
        $this->view->form = $form;
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $status->setId($status->getSequenceId());
            $form->bind($post, $status);
            $error = Status::checkValidations($post);
            if (count($error) != 0) {
                foreach ($error as $er) {
                    $this->flashSession->error($this->helper->translate($er));
                }
            } else {
                if ($status->save()) {
                    $this->flashSession->success($this->helper->translate('Tạo trạng thái thành công'));
                    return $this->redirect('/admin/status/listStatus');
                } else {
                    foreach ($status->getMessages() as $message) {
                        $this->flashSession->error($this->helper->translate($message->getMessage()));
                    }
                    $form->setEntity($post);
                }
            }
        }
    }

    public function viewStatusAction($id)
    {
        $this->view->activemenu = [
            'user',
            'status_list'
        ];
        $this->view->names = [
            [
                'label' => 'Xem thông tin trạng thái',
                'href' => '/admin/status/listStatus'
            ],
        ];
        $form = new StatusForm();
        $form->view();

        $status = Status::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        $form->setEntity($status);
        $this->view->form = $form;
    }

    public function editStatusAction($id)
    {
        $this->view->activemenu = [
            'user',
            'status_list'
        ];
        $this->view->names = [
            [
                'label' => 'Chỉnh sửa trạng thái',
                'href' => '/admin/status/listStatus'
            ],
        ];
        $form = new StatusForm();
        $form->edit();

        $status = Status::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            if($post['name'] != $status->getName())
            {
                $check=Status::findFirst([
                    'conditions'=>'name=:name:',
                    'bind'=>[
                        'name'=>$post['name']
                    ]
                ]);
                if($check)
                {
                    $this->flashSession->error('Tên trạng thái đã tồn tại');
                    return $this->redirect('/admin/status/listStatus');
                }
            }
            if($post['code'] != $status->getCode())
            {
                $check=Status::findFirst([
                    'conditions'=>'code=:code:',
                    'bind'=>[
                        'code'=>$post['code']
                    ]
                ]);
                if($check)
                {
                    $this->flashSession->error('Mã số trạng thái đã tồn tại');
                    return $this->redirect('/admin/status/listStatus');
                }
            }
            $form->bind($post, $status);
            if ($status->save()) {
                $this->flashSession->success($this->helper->translate('Chỉnh sửa trạng thái thành công'));
                return $this->redirect('/admin/status/listStatus');
            } else {
                foreach ($status->getMessages() as $message) {
                    $this->flashSession->error($this->helper->tranlate($message->getMessage()));
                }
            }
        } else {
            $form->setEntity($status);
        }

        $this->view->form = $form;
    }

    public function deleteStatusAction($id)
    {
        $this->view->disable();
        $status_id_disable = Status::getStatusIdByCode('disable');

        $status = Status::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($status) {

            $status->delete();
            $this->redirect('/admin/status/listStatus');
        } else {
            $this->flashSession->warning($this->helper->translate('Không tìm thấy trạng thái'));
        }
    }


}

