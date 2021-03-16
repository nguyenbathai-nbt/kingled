<?php

namespace Publisher\Modules\Producer\Controllers;


use Publisher\Common\Models\Bill\Conveyors;
use Publisher\Common\Models\Bill\Producer;
use Publisher\Common\Mvc\DashboardControllerBase;
use Publisher\Modules\Producer\Forms\ReportForm;


class ProducerController extends DashboardControllerBase
{
    private $limit_of_page = 10;

    public function initialize()
    {
        parent::initialize();
        $this->view->names = [
            [
                'label' => 'Producer',
                'href' => '/producer'
            ],
        ];
        $this->view->activemenu = [
            'db'
        ];

    }

    public function indexAction()
    {
        $auth = $this->session->get('auth-identity');
        $current_page = $this->request->getQuery('page', 'int', 1);
        $this->view->activemenu = [
            'bc',
            'producer_list'
        ];
        $list_producer = Conveyors::find();
        $count_recipient = [];
        $total_list_producer = Conveyors::count();
        if (count($list_producer) == 0) {
            $this->view->producers = null;
        } else {
            $this->view->producers = $list_producer;
            $this->view->count_recipient = $count_recipient;
        }
        $this->view->paging = $this->helper->util()->paging($total_list_producer, $this->request->getQuery(), $this->limit_of_page, $current_page);


    }

    public function createAction()
    {
        $this->view->activemenu = [
            'bc',
            'product_create'
        ];
        $this->view->names = [
            [
                'label' => 'Tạo mới người dùng',
                'href' => '/producer/create'
            ]

        ];
        $form = new ReportForm();
        $form->createconveyor();

        $conveyor = new Conveyors();
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $conveyor);
            if ($conveyor->create()) {
                $this->flashSession->success($this->helper->translate('Tạo chuyền thành công thành công'));
                return $this->redirect('/producer');
            } else {
                foreach ($conveyor->getMessages() as $message) {
                    $this->flashSession->error($this->helper->translate($message->getMessage()));
                }
                $form->setEntity($post);

            }
        }
        $this->view->form = $form;

    }

    public function deleteAction($id)
    {
        $this->view->disable();
        $conveyor = Conveyors::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($conveyor) {
            $conveyor->delete();

            $this->flashSession->success($this->helper->translate('Xóa thành công'));
        } else {
            $this->flashSession->warning($this->helper->translate('Không tìm thấy chuyền'));
        }
        return $this->redirect('/producer');

    }

    public function editAction($id)
    {
        $this->view->activemenu = [
            'bc',
            'product_create'
        ];
        $this->view->names = [
            [
                'label' => 'Chỉnh sửa chuyền',
                'href' => '/producer/edit'
            ]

        ];
        $form = new ReportForm();
        $form->editconveyor();

        $conveyor = Conveyors::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        $auth = $this->session->get('auth-identity');
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $conveyor);
            if ($conveyor->update()

            ) {
                $this->flashSession->success($this->helper->translate('Tạo chuyền thành công thành công'));
                return $this->redirect('/producer');
            } else {
                foreach ($conveyor->getMessages() as $message) {
                    $this->flashSession->error($this->helper->translate($message->getMessage()));
                }
                $form->setEntity($post);

            }
        } else {
            $form->setEntity($conveyor);
        }
        $this->view->form = $form;

    }


}

