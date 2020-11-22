<?php

namespace Publisher\Modules\Api\Controllers;


class ApiController extends RestController
{
    public function initialize()
    {
//        if ($this->checkApiKey() == true)
//            return true;
//        else {
//            $this->renderLog('Can not find api key');
//            die();
//        }
    }

    public function getAllUserAction()
    {

    }

    public function getAllStatusAction()
    {
        $this->getAllStatus();
        die();
    }

        public function getAllBillAction()
    {
        $this->getAllBill();
        die();
    }

    public function getBillDetailByBillIdAction($bill_id)
    {
        $this->getBillDetailByBillId($bill_id);
        die();
    }
    public function getTimeInTimeOutByBillIdAction($bill_id){
        $this->getTimeInTimeOutByBillId($bill_id);
        die();
    }

    public function getAllMajorAction()
    {
        $this->getAllMajor();
        die();
    }

    public function getAllProductAction()
    {
        $this->getAllProduct();
        die();
    }

    public function getAllRoleAction()
    {
        $this->getAllRole();
        die();
    }

    public function createBillAction()
    {
        if($this->request->isPost())
        {
            $this->createBill($this->request->getPost());
        }else{
            $this->renderLog('Không tìm thấy phương thúc này');
        }

        die();
    }

    public function updateTimeInAction()
    {

        $this->updateTimeIn($this->request->getQuery('user_id'), $this->request->get('timeintimeout_id'));
        die();
    }

    public function updateTimeOutAction()
    {

        $this->updateTimeOut($this->request->getQuery('user_id'),$this->request->get('timeintimeout_id'));
        die();

    }
    public function updateQuantityAction()
    {

        $this->updateQuantity($this->request->getQuery('id_timeintimeout'),$this->request->get('quantity'));
        die();

    }




}

