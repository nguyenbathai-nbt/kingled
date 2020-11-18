<?php

namespace Publisher\Modules\Bill\Controllers;

use Phalcon\Tag;
use Publisher\Common\Models\Badge\BadgeTemplate;
use Publisher\Common\Models\Bill\Bill;
use Publisher\Common\Models\Bill\BillDetail;
use Publisher\Common\Models\Bill\Product;
use Publisher\Common\Models\Bill\TimeinTimeout;
use Publisher\Common\Mvc\DashboardControllerBase;
use Publisher\Modules\Bill\Forms\IssuedForm;
use Publisher\Modules\Bill\Forms\BillForm;


class BillController extends DashboardControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->view->names = [
            [
                'label' => 'Issuer',
                'href' => '/bill'
            ],
        ];
    }

    public function indexAction()
    {
        $this->view->activemenu = [
            'is',
            'issuer_list'
        ];
        $this->view->issued = null;
        $auth = $this->session->get('auth-identity');
        $current_page = $this->request->getQuery('page', 'int', 1);
        $limit_of_page = 10;
        $list_bill = Bill::find([
            'limit' => $this->limit_of_page,
            'offset' => (($current_page - 1) * $limit_of_page),
            'order' => 'id ASC'
        ]);

        $total_list_bill = Bill::count([

        ]);
        if (count($list_bill) == 0) {
            $this->view->bills = null;
        } else {
            $this->view->bills = $list_bill;
        }
        $this->view->paging = $this->helper->util()->paging($total_list_bill, $this->request->getQuery(), $limit_of_page, $current_page);

    }

    public function createAction()
    {
        $this->view->activemenu = [
            'is',
            'issuer_create'
        ];
        $bill = new Bill();

        $form = new BillForm();
        $form->createbill();
        $this->view->form = $form;
        if ($this->request->isPost()) {
            $post = $this->request->getPost();

            $form->bind($post, $bill);
            $this->db->begin();
            if($bill->save())
            {
                $bill_detail= new BillDetail();
                $form->bind($post,$bill_detail);
                $bill_detail->setBillId($bill->getId());
                if($bill_detail->save())
                {
                    $parent_id=null;
                    for ($i=1;$i<=5;$i++)
                    {
                        $timein_timeout= new TimeinTimeout();
                        $timein_timeout->setBillId($bill->getId());
                        $timein_timeout->setProductId($bill_detail->getProductId());
                        $timein_timeout->setQuantity($bill_detail->getQuantity());
                        $timein_timeout->setMajorId($i);
                        $timein_timeout->setParentId($parent_id);
                        $timein_timeout->save();
                        $parent_id= $timein_timeout->getId();
                    }
                }
                $this->db->commit();
                $this->flashSession->success($this->helper->translate('Create bill success'));
                return $this->redirect('/bill');

            }else{

            }

        }else{

        }
        $this->view->form = $form;

    }

    public function deleteAction($id)
    {
        $this->view->disable();
        $bill = Bill::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($bill) {
            $bill->setStatusId('2');
            $bill->update();

            $this->flashSession->success($this->helper->translate('Delete success'));
        } else {
            $this->flashSession->warning($this->helper->translate('Not found user'));
        }
        return $this->redirect('/bill');

    }

    public function editAction($id)
    {
        $this->view->activemenu = [
            'bc',
            'group_edit'
        ];
        $this->view->names = [
            [
                'label' => 'Edit Bill',
                'href' => '/bill/edit'
            ]

        ];
        $form = new BillForm();
        $form->editbill();

        $bill = Bill::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        $auth = $this->session->get('auth-identity');
        $this->db->begin();
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setEntity($post);
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $form->bind($post, $bill);

            if (!$bill->save()) {
                foreach ($bill->getMessages() as $message) {
                    $this->flashSession->error($this->helper->translate($message));
                }
                $form->setEntity($bill);
            } else {
                $this->db->commit();
                $this->flashSession->success('Cập nhật hóa đơn thành công');
                return $this->redirect('/bill');
            }


        } else {
            $form->setEntity($bill);
        }
        $this->view->form = $form;

    }

}

