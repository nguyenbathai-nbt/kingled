<?php

namespace Publisher\Modules\Bill\Controllers;

use Phalcon\Tag;
use Publisher\Common\Models\Bill\Bill;
use Publisher\Common\Models\Bill\BillDetail;
use Publisher\Common\Models\Bill\TimeinTimeout;
use Publisher\Common\Mvc\DashboardControllerBase;
use Publisher\Modules\Bill\Forms\BillForm;
use Publisher\Modules\Bill\Forms\IssuedForm;


class BillController extends DashboardControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->view->names = [
            [
                'label' => 'Hóa đơn',
                'href' => '/bill'
            ],
        ];
    }

    public function indexAction()
    {
        $this->view->activemenu = [
            'bill',
            'bill_list'
        ];
        $this->view->issued = null;
        $auth = $this->session->get('auth-identity');
        $current_page = $this->request->getQuery('page', 'int', 1);
        $limit_of_page = 10;
        $list_bill = BillDetail::find([
            'limit' => $limit_of_page,
            'offset' => (($current_page - 1) * $limit_of_page),
            'order' => 'id ASC'
        ]);

        $total_list_bill = BillDetail::count([

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
            if ($bill->save()) {
                $bill_detail = new BillDetail();
                $form->bind($post, $bill_detail);
                $bill_detail->setBillId($bill->getId());
                if ($bill_detail->save()) {
                    $parent_id = null;
                    for ($i = 1; $i <= 5; $i++) {
                        $timein_timeout = new TimeinTimeout();
                        $timein_timeout->setBillId($bill->getId());
                        $timein_timeout->setProductId($bill_detail->getProductId());
                        $timein_timeout->setQuantity(0);
                        $timein_timeout->setMajorId($i);
                        $timein_timeout->setParentId($parent_id);
                        $timein_timeout->save();
                        $parent_id = $timein_timeout->getId();
                    }
                }
                $this->db->commit();
                $this->flashSession->success($this->helper->translate('Create bill success'));
                return $this->redirect('/bill');

            } else {
                foreach ($bill->getMessages() as $message) {
                    $this->flashSession->error($this->helper->translate($message['_message']));
                }
                $form->setEntity($bill);
            }

        } else {
            Tag::setDefaults([
                'code' => $this->generateCode(),
                'name' => $this->generateCode(),
            ]);
        }
        $this->view->form = $form;

    }

    public function generateCode()
    {
        $last_bill = Bill::findFirst([
            'conditions' => 'code LIKE :code:',
            'bind' => [
                'code' => '%' . date('mY') . '%'
            ],
            'order' => 'id DESC'
        ]);
        if ($last_bill) {
            $code = mb_split('-', $last_bill->getCode());
            if ($code[0] == date('mY')) {
                $count = (int)$code[1] + 1;
                if (strlen($count) == 1) {
                    $count = (string)'00' . (string)$count;
                } else if (strlen($count) == 2) {
                    $count = (string)'0' . (string)$count;
                }
                $new_code = $code[0] . '-' . $count;
            } else {
                $new_code = date('mY') . '-' . '001';
            }
        } else {
            $new_code = date('mY') . ' - ' . '001';
        }
        return $new_code;
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
            'bill',
            'bill_list'
        ];
        $this->view->names = [
            [
                'label' => 'Sửa hóa đơn',
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
        $bill_detail = BillDetail::findFirst([
            'conditions' => 'bill_id=:bill_id:',
            'bind' => [
                'bill_id' => $id
            ]
        ]);
        $timein_timeout = TimeinTimeout::find([
            'conditions' => 'bill_id=:bill_id:',
            'bind' => [
                'bill_id' => $id
            ],
            'order' => 'major_id ASC'
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
                $form->bind($post, $bill_detail);
                if ($bill_detail->save()) {

                    $this->db->commit();
                }

                $this->flashSession->success('Cập nhật hóa đơn thành công');
                return $this->redirect('/bill');
            }


        } else {
            Tag::setDefaults([
                'name' => $bill->getName(),
                'code' => $bill->getCode(),
                'quantity' => $bill_detail->getQuantity(),
                'product_id' => $bill_detail->getProductId(),
                'note' => $bill_detail->getNote(),
                'description' => $bill_detail->getDescription(),
                'conveyor_id' => $bill_detail->getConveyorId()
            ]);
            $form->setEntity($bill);
            $this->view->bills = $bill;
            $this->view->timeintimeout = $timein_timeout;
        }
        $this->view->id_time = TimeinTimeout::findFirst([
            'conditions' => 'major_id=:major_id: and bill_id=:bill_id:',
            'bind' => [
                'major_id' => 1,
                'bill_id' => $id
            ]
        ]);
        $this->view->form = $form;

    }

    public function editTimeInAction($timeintimeout_id)
    {
        $this->view->disable();
        $auth = $this->session->get('auth-identity');
        $timeintimein = TimeinTimeout::findFirst([
            'conditions' => 'id =:id:',
            'bind' => [
                'id' => $timeintimeout_id
            ]
        ]);
        if ($timeintimein) {
            if ($timeintimein->getMajorId() == 1) {
                $timeintimein->setTimeIn(date('Y-m-d H:i:s'));
                $timeintimein->setUserTimeInId($auth['id']);
                $timeintimein->save();
                $this->flashSession->success($this->helper->translate('Cập nhật thành công'));
            } else {
                $befor_timein = TimeinTimeout::findFirst([
                    'conditions' => 'id=:id:',
                    'bind' => [
                        'id' => $timeintimein->getParentId()
                    ]
                ]);
                if ($befor_timein->getTimeOut() == null || empty($befor_timein->getTimeOut()) || $befor_timein->getTimeOut() == 'null') {
                    $this->flashSession->warning($this->helper->translate('Nghiệp vụ trước chưa cập nhật thời gian đóng. Vui lòng cập nhật thời gian'));
                } else {
                    $timeintimein->setTimeIn(date('Y-m-d H:i:s'));
                    $timeintimein->setUserTimeInId($auth['id']);
                    $timeintimein->save();
                    $this->flashSession->success($this->helper->translate('Cập nhật thành công'));

                }
            }
        } else {
            $this->flashSession->warning($this->helper->translate('Không tìm thấy'));

        }
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function editTimeOutAction($id_timeout)
    {
        $this->view->disable();
        $auth = $this->session->get('auth-identity');
        $timeintimein = TimeinTimeout::findFirst([
            'conditions' => 'id =:id:',
            'bind' => [
                'id' => $id_timeout
            ]
        ]);
        if($timeintimein->getTimeIn() == null && $timeintimein->getUserTimeInId() == null)
        {
            $this->flashSession->warning($this->helper->translate('Cập nhật thời gian vào trước'));
        }else{
            $timeout = TimeinTimeout::findFirst([
                'conditions' => 'id=:id:',
                'bind' => [
                    'id' => $id_timeout
                ]
            ]);
            if ($timeout) {
                $timeout->setTimeOut(date('Y-m-d G:i:s'));
                $timeout->setCountTime(strtotime($timeout->getTimeOut()) - strtotime($timeout->getTimeIn()));
                $timeout->setUserTimeoutId($auth['id']);
                $timeout->update();

                $this->flashSession->success($this->helper->translate('Cập nhật thành công'));
            } else {
                $this->flashSession->warning($this->helper->translate('Không tìm thấy'));
            }
        }

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function updateQuantityAction($id)
    {
        $this->view->disable();
        $quantity = $this->request->getPost('quantity');
        $timein_timeout = TimeinTimeout::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        $this->db->begin();
        if ($timein_timeout) {
            $timein_timeout->setQuantity($quantity);
            $bill_detail = BillDetail::findFirst([
                'conditions' => 'bill_id=:bill_id:',
                'bind' => [
                    'bill_id' => $timein_timeout->getBillId()
                ]
            ]);
            if ($bill_detail) {
                $bill_detail->setQuantity($quantity);
                $bill_detail->update();
                $time = TimeinTimeout::find([
                    'conditions' => 'bill_id=:bill_id:',
                    'bind' => [
                        'bill_id' => $bill_detail->getBillId(),
                    ]
                ]);
                foreach ($time as $item) {
                    $item->setQuantity($quantity);
                    $item->update();
                }
            }
            $this->db->commit();
            $this->flashSession->success($this->helper->translate('Cập nhật thành công'));

        } else {
            $this->flashSession->warning($this->helper->translate('Không tìm thấy'));
        }
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }


}

