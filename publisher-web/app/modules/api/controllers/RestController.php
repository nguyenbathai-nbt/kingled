<?php

namespace Publisher\Modules\Api\Controllers;

use Phalcon\Mvc\Controller;
use Publisher\Common\Models\Bill\Bill;
use Publisher\Common\Models\Bill\BillDetail;
use Publisher\Common\Models\Bill\Conveyors;
use Publisher\Common\Models\Bill\Product;
use Publisher\Common\Models\Bill\TimeinTimeout;
use Publisher\Common\Models\Users\Major;
use Publisher\Common\Models\Users\Role;
use Publisher\Common\Models\Users\Status;
use Publisher\Common\Models\Users\Users;
use Publisher\Common\Mvc\Auth;


/**
 * Class RestController.
 * Base class for all controllers for REST API.
 *
 * @package Api\Controller
 */
class RestController extends Controller
{

    /**
     * Render data from payload
     *
     * @return \Phalcon\Http\ResponseInterface
     * @throws \Api\Exception\NotImplementedException
     *
     */
    protected function getListGroup()
    {
        $header = apache_request_headers();
//        $user = Product::findFirst([
//            'conditions' => 'user_key=:user_key:',
//            'bind' => [
//                'user_key' => $header['apikey']
//            ]
//        ]);
        $format = $this->request->getQuery('format', null, 'json');
//        $list_group = Group::find([
//            'conditions' => 'owner_id=:owner_id:',
//            'bind' => [
//                'owner_id' => $user->getId()
//            ],
//            'order' => 'group_code ASC'
//        ]);
//        $list_group = [
//            "groups" => $list_group
//        ];
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($header);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function renderLog($content)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $log[] = $content;
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($log);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getAllStatus()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list_status = Status::find();
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list_status);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getAllUser()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list_user = Users::find();
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list_user);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getAllBill()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list_bill = Bill::find();
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list_bill);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getBillDetailByBillId($user_id, $bill_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $bill_detail = BillDetail::findFirst([
            'conditions' => 'bill_id=:bill_id:',
            'bind' => [
                'bill_id' => $bill_id
            ]
        ]);
        $bill = Bill::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $bill_id
            ]
        ]);
        if (!$bill_detail) {
            $list = [
                'error' => 'Không tìm thấy hóa đơn'
            ];
        } else {
            $user = Users::findFirst([
                'conditions' => 'id=:id:',
                'bind' => [
                    'id' => $user_id
                ]
            ]);
            if ($user->role->getMajorId() == 6) {
                $timein_timeout = TimeinTimeout::find([
                    'conditions' => 'bill_id=:bill_id:',
                    'bind' => [
                        'bill_id' => $bill_id,
                    ]
                ]);
            } else {
                $timein_timeout = TimeinTimeout::find([
                    'conditions' => 'bill_id=:bill_id: and major_id <= :major_id:',
                    'bind' => [
                        'bill_id' => $bill_id,
                        'major_id' => $user->role->major->getId()
                    ],
                    'order' => 'major_id ASC'
                ]);
            }
            $list_timein_timeout = [];
            foreach ($timein_timeout as $item) {
                $items = [
                    'id' => $item->getId(),
                    'bill_id' => $item->getBillId(),
                    'product_id' => $item->getProductId(),
                    'product_name' => $item->product->getName(),
                    'product_code' => $item->product->getCode(),
                    'quantity' => $item->getQuantity(),
                    'time_in' => $item->getTimeIn(),
                    'user_timein_id' => $item->getUserTimeinId(),
                    'time_out' => $item->getTimeOut(),
                    'user_timeout_id' => $item->getUserTimeoutId(),
                    'major_id' => $item->getMajorId(),
                    'major_code' => $item->major->getCode(),
                    'major_name' => $item->major->getName(),
                    'delay_status' => $item->getDelayStatus(),
                    'count_time' => $item->getCountTime(),
                    'parent_id' => $item->getParentId(),
                    'description' => $item->getDescription()
                ];
                $list_timein_timeout[] = $items;
            }
            if ($bill_detail->getConveyorId() == '' || $bill_detail->getConveyorId() == 'null' || $bill_detail->getConveyorId() == null || empty($bill_detail->getConveyorId())) {
                $list = [
                    'bill_detail' => [
                        'id' => $bill_detail->getId(),
                        'bill_id' => $bill_detail->getBillId(),
                        'product_id' => $bill_detail->getproductId(),
                        'quantity' => $bill_detail->getQuantity(),
                        'description' => $bill_detail->getDescription(),
                        'note' => $bill_detail->getNote(),
                        'time_in' => $bill_detail->getTimeIn(),
                        'time_out' => $bill_detail->getTimeOut(),
                        'created_time' => $bill_detail->getCreatedTime(),
                        'modified_time' => $bill_detail->getModifiedTime(),
                        'conveyor' => $bill_detail->getConveyorId(),
                        'status' => $bill->getStatusId(),
                        'product_name' => $bill_detail->product->getName()
                    ],
                    'timein_timeout' => $list_timein_timeout
                ];
            } else {
                $list = [
                    'bill_detail' => [
                        'id' => $bill_detail->getId(),
                        'bill_id' => $bill_detail->getBillId(),
                        'product_id' => $bill_detail->getproductId(),
                        'quantity' => $bill_detail->getQuantity(),
                        'description' => $bill_detail->getDescription(),
                        'note' => $bill_detail->getNote(),
                        'time_in' => $bill_detail->getTimeIn(),
                        'time_out' => $bill_detail->getTimeOut(),
                        'created_time' => $bill_detail->getCreatedTime(),
                        'modified_time' => $bill_detail->getModifiedTime(),
                        'conveyor' => $bill_detail->conveyor,
                        'status' => $bill->getStatusId(),
                        'product_name' => $bill_detail->product->getName()
                    ],
                    'timein_timeout' => $list_timein_timeout,

                ];
            }
        }


        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getBillDetailByStatusId($status_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list_bill = Bill::find();
        $list = [];
        foreach ($list_bill as $item) {
            $bill_detail = BillDetail::findFirst([
                'conditions' => 'bill_id =:bill_id:',
                'bind' => [
                    'bill_id' => $item->getId()
                ]
            ]);
            if ($bill_detail->getConveyorId() == '' || $bill_detail->getConveyorId() == 'null' || $bill_detail->getConveyorId() == null || empty($bill_detail->getConveyorId())) {
                $list[] = [
                    'bill' => $item,
                    'bill_detail' => [
                        'id' => $bill_detail->getId(),
                        'bill_id' => $bill_detail->getBillId(),
                        'product_id' => $bill_detail->getproductId(),
                        'quantity' => $bill_detail->getQuantity(),
                        'description' => $bill_detail->getDescription(),
                        'note' => $bill_detail->getNote(),
                        'time_in' => $bill_detail->getTimeIn(),
                        'time_out' => $bill_detail->getTimeOut(),
                        'created_time' => $bill_detail->getCreatedTime(),
                        'modified_time' => $bill_detail->getModifiedTime(),
                        'conveyor' => $bill_detail->getConveyorId()
                    ],
                    'product' => $bill_detail->product,
                    'status' => $item->status
                ];
            } else {
                $list[] = [
                    'bill' => $item,
                    'bill_detail' => [
                        'id' => $bill_detail->getId(),
                        'bill_id' => $bill_detail->getBillId(),
                        'product_id' => $bill_detail->getproductId(),
                        'quantity' => $bill_detail->getQuantity(),
                        'description' => $bill_detail->getDescription(),
                        'note' => $bill_detail->getNote(),
                        'time_in' => $bill_detail->getTimeIn(),
                        'time_out' => $bill_detail->getTimeOut(),
                        'created_time' => $bill_detail->getCreatedTime(),
                        'modified_time' => $bill_detail->getModifiedTime(),
                        'conveyor' => $bill_detail->conveyor,
                    ],
                    'product' => $bill_detail->product,
                    'status' => $item->status
                ];
            }
        }
        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function generateCodeBill()
    {
        $format = $this->request->getQuery('format', null, 'json');
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

        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($new_code);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getTimeInTimeOutByBillId($bill_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list_bill_detail = TimeinTimeout::find([
            'conditions' => 'bill_id =:bill_id:',
            'bind' => [
                'bill_id' => $bill_id
            ]
        ]);
        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($list_bill_detail);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getAllProduct()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list_product = Product::find();
        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($list_product);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getAllRole()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list_role = Role::find();
        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($list_role);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getAllMajor()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list_major = Major::find();
        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($list_major);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function createBill($post)
    {
        $format = $this->request->getQuery('format', null, 'json');
        //  $array=json_encode($post);
        //  $post=json_decode($array,true);

        if ($post) {
            $respone = [];
            if (!$post['name']) {
                $respone[] = 'Không có dữ liệu tên hóa đơn(name)';
            }
            if (!$post['code']) {
                $respone[] = 'Không có dữ liệu mã hóa đơn(code)';
            }
            if (!$post['quantity']) {
                $respone[] = 'Không có dữ liệu số lượng sản phẩm(quantity)';
            }
            if (!$post['product_id']) {
                $respone[] = 'Không có dữ liệu id sản phẩm(product_id)';
            }
            if (!$post['status_id']) {
                $respone[] = 'Không có dữ liệu id trạng thái(status_id)';
            }
            if (!$post['priority']) {
                $respone[] = 'Không có dữ liệu độ ưu tiên(priority)';
            }
            $this->db->begin();
            if ($respone == null) {
                $bill = new Bill();
                $bill->setName($post['name']);
                $bill->setCode($post['code']);
                $bill->setStatusId($post['status_id']);
                $bill->setPriority($post['priority']);
                if ($bill->create()) {
                    $bill_detail = new BillDetail();
                    $bill_detail->setBillId($bill->getId());
                    $bill_detail->setProductId($post['product_id']);
                    $bill_detail->setQuantity($post['quantity']);
                    $bill_detail->setDescription($post['description']);
                    $bill_detail->setNote($post['note']);
                    if ($bill_detail->create()) {
                        $parent_id = null;
                        for ($i = 1; $i <= 5; $i++) {
                            $timein_timeout = new TimeinTimeout();
                            $timein_timeout->setBillId($bill->getId());
                            $timein_timeout->setProductId($bill_detail->getProductId());
                            $timein_timeout->setQuantity(0);
                            $timein_timeout->setMajorId($i);
                            $timein_timeout->setParentId($parent_id);
                            if ($timein_timeout->create()) {

                            } else {
                                $respone = ['error' => 'Không tạo thời gian vào ra thành công'];
                                break;
                            }
                            $parent_id = $timein_timeout->getId();
                        }
                        $this->db->commit();
                        $respone = ['bill' => $bill];
                        //  $respone = ['success' => 'Tạo hóa đơn mói thành công'];
                    } else {
                        $respone = ['error' => 'Không chi tiết tạo hóa đơn thành công'];
                    }


                } else {
                    $respone = ['error' => 'Không tạo hóa đơn thành công'];
                }
            }

        } else {
            $respone = ['error' => 'Không nhận được dữ liệu'];
        }

        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($respone);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function updateTimeIn($user_id, $timeintimeout_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $timeintimein = TimeinTimeout::findFirst([
            'conditions' => 'id =:id:',
            'bind' => [
                'id' => $timeintimeout_id
            ]
        ]);
        if ($timeintimein) {
//            if ($timeintimein->getDelayStatus() == 1) {
//                $timeintimein = [
//                    'error' => 'Hóa đơn đang trạng thái trì hoãn'
//                ];
//            } else {
//                if ($timeintimein->getMajorId() == 1) {
//                    if ($timeintimein->getTimeIn() == null || empty($timeintimein->getTimeIn()) || $timeintimein->getTimeIn() == 'null' || $timeintimein->getTimeIn() == '') {
//
            $timeintimein->setTimeIn(date('Y-m-d H:i:s'));
            $timeintimein->setUserTimeInId($user_id);
            $timeintimein->save();
//                    } else {
//                        $timeintimein = [
//                            'warning' => 'Thời gian vào đã được cập nhật từ trước'
//                        ];
//                    }
//                } else {
//                    $befor_timein = TimeinTimeout::findFirst([
//                        'conditions' => 'id=:id:',
//                        'bind' => [
//                            'id' => $timeintimein->getParentId()
//                        ]
//                    ]);
//                    if ($befor_timein->getTimeOut() == null || empty($befor_timein->getTimeOut()) || $befor_timein->getTimeOut() == 'null') {
//                        $timeintimein = [
//                            'error' => 'Nghiệp vụ trước chưa cập nhật thời gian đóng. Vui lòng cập nhật thời gian'
//                        ];
//                    } else {
//                        if ($timeintimein->getTimeIn() == null || empty($timeintimein->getTimeIn()) || $timeintimein->getTimeIn() == 'null' || $timeintimein->getTimeIn() == '') {
//                            $timeintimein->setTimeIn(date('Y-m-d H:i:s'));
//                            $timeintimein->setUserTimeInId($user_id);
//                            $timeintimein->save();
//                        } else {
//                            $timeintimein = [
//                                'warning' => 'Thời gian vào đã được cập nhật từ trước'
//                            ];
//                        }
//
//                    }
//                }
//            }
        } else {
            $timeintimein = [
                'error' => 'Không tìm thấy bản ghi'
            ];
        }
        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($timeintimein);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function updateTimeOut($user_id, $timeintimeout_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $timeintimein = TimeinTimeout::findFirst([
            'conditions' => 'id =:id:',
            'bind' => [
                'id' => $timeintimeout_id
            ]
        ]);
        if ($timeintimein->getTimeIn() == null && $timeintimein->getUserTimeInId() == null) {
            $timeintimeout = [
                'error' => 'Cập nhật thời gian vào trước'
            ];
        } else {
            $timeintimeout = TimeinTimeout::findFirst([
                'conditions' => 'id =:id:',
                'bind' => [
                    'id' => $timeintimeout_id
                ]
            ]);
            if ($timeintimeout) {
//                if ($timeintimeout->getDelayStatus() == 1) {
//                    $timeintimeout = [
//                        'error' => 'Hóa đơn đang trạng thái trì hoãn'
//                    ];
//                } else {
//                    if ($timeintimeout->getTimeIn() == null || empty($timeintimeout->getTimeIn()) || $timeintimeout->getTimeIn() == 'null') {
//                        $timeintimeout = [
//                            'error' => 'Chưa cập nhật thời gian vào. Vui lòng cập nhật thời gian vào trước'
//                        ];
//                    } else {
//                        if ($timeintimeout->getTimeOut() == null || empty($timeintimeout->getTimeOut()) || $timeintimeout->getTimeOut() == 'null' || $timeintimeout->getTimeOut() == '') {
                $timeintimeout->setTimeOut(date('Y-m-d G:i:s'));
                $timeintimeout->setCountTime($timeintimeout->getCountTime() + (strtotime($timeintimeout->getTimeOut()) - strtotime($timeintimeout->getTimeIn())));
                $timeintimeout->setUserTimeOutId($user_id);
                $timeintimeout->save();
//                        } else {
//                            $timeintimeout = [
//                                'warning' => 'Thời gian ra đã được cập nhật từ trước'
//                            ];
//                        }
//                    }
//                }
            } else {
                $timeintimeout = [
                    'error' => 'Không tìm thấy bản ghi'
                ];
            }
        }

        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($timeintimeout);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function updateQuantity($id_timeintimeout, $quantity)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $id = $id_timeintimeout;
        $timein_timeout = TimeinTimeout::findFirst([
            'conditions' => 'id =:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        $this->db->begin();
        if ($timein_timeout) {
            $bill_detail = BillDetail::findFirst([
                'conditions' => 'bill_id =:bill_id:',
                'bind' => [
                    'bill_id' => $timein_timeout->getBillId()
                ]
            ]);
            if ($bill_detail) {
                $bill_detail->setQuantity($quantity);
                $bill_detail->update();
                $time = TimeinTimeout::find([
                    'conditions' => 'bill_id =:bill_id:',
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
        }

        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($timein_timeout);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function updateProducer($conveyor_id, $bill_id)
    {
        $format = $this->request->getQuery('format', null, 'json');

        $bill_detail = BillDetail::findFirst([
            'conditions' => 'bill_id =:bill_id:',
            'bind' => [
                'bill_id' => $bill_id
            ]
        ]);

        if ($bill_detail) {
            $bill_detail->setConveyorId($conveyor_id);
            $bill_detail->save();

        } else {
            $bill_detail = [
                'error' => 'Không tìm thấy hóa đơn'
            ];
        }

        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($bill_detail);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getAllConveyor()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $conveyor = Conveyors::find();
        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($conveyor);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function setBillClosed($bill_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $bill = Bill::findFirst([
            'conditions' => 'id =:id:',
            'bind' => [
                'id' => $bill_id
            ]
        ]);
        if ($bill) {
            $status = Status::findFirst(['conditions' => 'code =:code:', 'bind' => ['code' => 'DA_XONG']]);
            $bill->setStatusId($status->getId());
            $bill->save();
            $respone = ['success' => 'Đổi trạng thái thành công'];
        } else {
            $respone = ['error' => 'Không tìm thấy hóa đơn'];
        }
        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($respone);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function login($post)
    {
        $format = $this->request->getQuery('format', null, 'json');
        //  $array=json_encode($post);
        //  $post=json_decode($array,true);
        if ($post) {
            $auth = new Auth();
            $credentials = [
                'username' => trim($post['username']),
                'password' => trim($post['password']),
                'remember' => ''
            ];
            $check = $auth->check($credentials);
            if ($check == 'true') {
                $user = Users::findFirst([
                    'conditions' => 'username =:username:',
                    'bind' => [
                        'username' => $post['username']
                    ]
                ]);
                $respone = [
                    'id' => $user->getId(),
                    'role_id' => $user->role->getId(),
                    'role_code' => $user->role->getCode(),
                    'major_id' => $user->role->major->getId(),
                    'major_code' => $user->role->major->getCode(),
                    'status_id' => $user->status->getId(),
                    'status_code' => $user->status->getCode(),
                ];
            } else {
                $respone = $check;
            }
        } else {
            $respone = ['error' => 'Không nhận được dữ liệu'];
        }

        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($respone);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function delayBill($bill_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $timeintimeout = TimeinTimeout::find([
            'conditions' => 'bill_id=:bill_id:',
            'bind' => [
                'bill_id' => $bill_id
            ]
        ]);
        $status_code = Status::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => 'TAM_HOAN'
            ]
        ]);
        $bill = Bill::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $bill_id
            ]
        ]);
        if ($timeintimeout) {
            foreach ($timeintimeout as $item) {
                if ($item->getTimeIn() != null && $item->getTimeOut() != null) {
                } else if ($item->getTimeIn() != null && $item->getTimeOut() == null) {
                    $item->setCountTime($item->getCountTime() + (strtotime(date('Y-m-d H:i:s')) - strtotime($item->getTimeIn())));
                }
                $item->setDelayStatus($status_code->getId());
                $item->update();

            }
            $bill->setStatusId($status_code->getId());
            $bill->update();
            $respone = [
                'success' => 'Trì hoãn hóa đơn thành công'
            ];
        } else {
            $respone = [
                'error' => 'Không tìm thấy bản ghi'
            ];
        }


        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($respone);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function turnOffDelayBill($bill_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $timeintimeout = TimeinTimeout::find([
            'conditions' => 'bill_id=:bill_id:',
            'bind' => [
                'bill_id' => $bill_id
            ]
        ]);
        $status_code = Status::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => 'DANG_TIEN_HANG'
            ]
        ]);
        $bill = Bill::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $bill_id
            ]
        ]);
        if ($timeintimeout) {
            foreach ($timeintimeout as $item) {
                if ($item->getTimeIn() != null && $item->getTimeOut() != null) {

                } else if ($item->getTimeIn() != null && $item->getTimeOut() == null) {
                    $item->setTimeIn(date('Y-m-d H:i:s'));
                }
                $item->setDelayStatus(null);
                $item->update();
            }
            $bill->setStatusId($status_code->getId());
            $bill->update();
            $respone = [
                'success' => 'Tắt trì hoãn hóa đơn thành công'
            ];
        } else {
            $respone = [
                'error' => 'Không tìm thấy bản ghi'
            ];
        }


        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($respone);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function checkDelayBill($bill_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $timeintimeout = TimeinTimeout::findFirst([
            'conditions' => 'bill_id=:bill_id:',
            'bind' => [
                'bill_id' => $bill_id
            ]
        ]);
        if ($timeintimeout) {
            if ($timeintimeout->getDelayStatus() == 1) {
                $respone = [
                    'delay' => 'Hóa đơn đang trong trạng thái trì hoãn'
                ];
            } else {
                $respone = [
                    'nodelay' => 'Hóa đơn không trong trạng thái trì hoãn'
                ];
            }
        } else {
            $respone = [
                'error' => 'Không tìm thấy bản ghi'
            ];
        }


        switch ($format) {
            case 'json':
                $contentType = 'application / json';
                $encoding = 'UTF-8';
                $content = json_encode($respone);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format % s is not supported yet . ', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }


}
