<?php

namespace Publisher\Modules\Bill\Controllers;

use Phalcon\Tag;
use Publisher\Common\Models\Bill\Bill;
use Publisher\Common\Models\Bill\BillDetail;
use Publisher\Common\Models\Bill\Product;
use Publisher\Common\Models\Bill\TimeinTimeout;
use Publisher\Common\Models\Users\Status;
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
        $form = new BillForm();
        $form->searchbill();
        $conditions = '';
        $bind = [];
        $get = $this->request->getQuery();
        if (isset($get['code_bill']) && $get['code_bill'] != "") {
            $bill = Bill::find([
                'conditions' => 'code LIKE :code:',
                'bind' => [
                    'code' => '%' . $get['code_bill'] . '%'
                ]
            ]);
            $list_bill_id = [];
            foreach ($bill as $item) {
                $list_bill_id[] = $item->getId();
            }
            $conditions .= 'bill_id in (' . implode(',', $list_bill_id) . ')';
        }
        $list_bill = BillDetail::find([
            'conditions' => $conditions,
            'bind' => $bind,
            'limit' => $limit_of_page,
            'offset' => (($current_page - 1) * $limit_of_page),
            'order' => 'id DESC'
        ]);

        $total_list_bill = BillDetail::count([]);
        if (count($list_bill) == 0) {
            $this->view->bills = null;
        } else {
            $this->view->bills = $list_bill;
        }
        $this->view->form = $form;
        $this->view->paging = $this->helper->util()->paging($total_list_bill, $this->request->getQuery(), $limit_of_page, $current_page);

    }

    public function createAction()
    {
        $this->view->activemenu = [
            'bill',
            'bill_create'
        ];
        $bill = new Bill();

        $form = new BillForm();
        $form->createbill();
        $this->view->form = $form;
        if ($this->request->isPost()) {
            $post = $this->request->getPost();

            $form->bind($post, $bill);
            $bill->setCode($bill->getName());
            $this->db->begin();
            $error = 0;
            if ($bill->save()) {
                $bill_detail = new BillDetail();
                $form->bind($post, $bill_detail);
                if (empty($bill_detail->getConveyorId())) {
                    $bill_detail->setConveyorId(null);
                }
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
                        if ($timein_timeout->save()) {

                        } else {
                            $error = 1;
                            foreach ($timein_timeout->getMessages() as $message) {
                                $this->flashSession->error($this->helper->translate($message['_message']));
                            }
                            break;
                        }
                        $parent_id = $timein_timeout->getId();
                    }
                } else {
                    $error = 1;
                    foreach ($bill_detail->getMessages() as $message) {
                        $this->flashSession->error($this->helper->translate($message['_message']));
                    }
                }

            } else {
                $error = 1;
                foreach ($bill->getMessages() as $message) {
                    $this->flashSession->error($this->helper->translate($message['_message']));
                }
            }
            if ($error == 0) {
                $this->db->commit();
                $this->flashSession->success($this->helper->translate('Create bill success'));
                return $this->redirect('/bill');
            } else {
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
            if (strpos($code[0], date('mY')) == 2) {
                $count = (int)$code[1] + 1;
                if (strlen($count) == 1) {
                    $count = (string)'00' . (string)$count;
                } else if (strlen($count) == 2) {
                    $count = (string)'0' . (string)$count;
                }
                $new_code = date('dmY') . '-' . $count;
            } else {
                $new_code = date('dmY') . '-' . '001';
            }
        } else {
            $new_code = date('dmY') . '-' . '001';
        }
        return $new_code;
    }

    public function generateCodeBillImport($date)
    {
        $last_bill = Bill::findFirst([
            'conditions' => 'code LIKE :code:',
            'bind' => [
                'code' => '%' . date('mY', strtotime($date)) . '%'
            ],
            'order' => 'id DESC'
        ]);
        if ($last_bill) {
            $code = mb_split('-', $last_bill->getCode());
            if (strpos($code[0], date('mY')) == 2) {
                $count = (int)$code[1] + 1;
                if (strlen($count) == 1) {
                    $count = (string)'00' . (string)$count;
                } else if (strlen($count) == 2) {
                    $count = (string)'0' . (string)$count;
                }
                $new_code = date('dmY') . '-' . $count;
            } else {
                $new_code = date('dmY') . '-' . '001';
            }
        } else {
            $new_code = date('dmY') . '-' . '001';
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
            'bill_create_import'
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
                'product_name' => $bill_detail->product->getName(),
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
        if ($timeintimein->getTimeIn() == null && $timeintimein->getUserTimeInId() == null) {
            $this->flashSession->warning($this->helper->translate('Cập nhật thời gian vào trước'));
        } else {
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

    public function displayNameProductByIdAction($id)
    {
        $this->view->disable();
        $product = Product::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);

        return json_encode($product->getName(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function importBillAction()
    {
        $this->view->activemenu = [
            'bill',
            'bill_create_import'
        ];
        $this->view->names = [
            [
                'label' => 'Thêm mới lệnh theo lô',
                'href' => '/bill/importbill'
            ]

        ];
        $form = new BillForm();

        $form->importbill();
        $status_code = Status::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => 'DANG_TIEN_HANG'
            ]
        ]);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $file = $_FILES['import']['tmp_name'];
            $data_import = $this->helper->import($file, 'IMPORT_TRANSCRIPT_BILL', $post)->getDataBill();
            $this->db->begin();
            $error = 0;

            foreach ($data_import as $item) {
                $bill = new Bill();
                $bill->setName($this->generateCodeBillImport($item['date']));
                $bill->setCode($this->generateCodeBillImport($item['date']));
                $bill->setStatusId($status_code->getId());
                $bill->setPriority((int)$item['priority']);
                if ($bill->save()) {
                    $bill_detail = new BillDetail();
                    if (empty($bill_detail->getConveyorId())) {
                        $bill_detail->setConveyorId(null);
                    }
                    $bill_detail->setBillId($bill->getId());
                    $product = Product::findFirst([
                        'conditions' => 'code=:code:',
                        'bind' => [
                            'code' => $item['product_code']
                        ]
                    ]);
                    $bill_detail->setProductId($product->getId());
                    $bill_detail->setQuantity($item['quantity']);
                    if (!empty($item['description'])) {
                        $bill_detail->setDescription($item['description']);
                    }
                    if ($bill_detail->save()) {
                        $parent_id = null;
                        for ($i = 1; $i <= 5; $i++) {
                            $timein_timeout = new TimeinTimeout();
                            $timein_timeout->setBillId($bill->getId());
                            $timein_timeout->setProductId($bill_detail->getProductId());
                            $timein_timeout->setQuantity(0);
                            $timein_timeout->setMajorId($i);
                            $timein_timeout->setParentId($parent_id);
                            if ($timein_timeout->save()) {

                            } else {
                                $error = 1;
                                $this->flashSession->success($this->helper->translate($item['product_code']));
                                foreach ($timein_timeout->getMessages() as $message) {
                                    $this->flashSession->error($this->helper->translate($message['_message']));
                                }
                                break;
                            }
                            $parent_id = $timein_timeout->getId();
                        }
                    } else {
                        $error = 1;
                        $this->flashSession->success($this->helper->translate($item['product_code']));
                        foreach ($bill_detail->getMessages() as $message) {
                            $this->flashSession->error($this->helper->translate($message['_message']));
                        }
                    }


                } else {
                    $error = 1;
                    $this->flashSession->success($this->helper->translate($item['product_code']));
                    foreach ($bill->getMessages() as $message) {
                        $this->flashSession->error($this->helper->translate($message['_message']));
                    }
                }
                if ($error == 0) {
                    //   $this->db->commit();
                    $this->flashSession->success($this->helper->translate('Create bill success'));
                    return $this->redirect('/bill/importbill');
                }
            }
        }
        $this->view->form = $form;
    }


}

