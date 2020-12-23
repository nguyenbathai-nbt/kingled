<?php

namespace Publisher\Modules\Api\Controllers;


class ApiController extends RestController
{
    public function initialize()
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
    public function getAllUserAction()
    {
        $this->getAllUser();
    }


    public function getBillDetailByBillIdAction()
    {
        $this->getBillDetailByBillId($this->request->getQuery('user_id'), $this->request->get('bill_id'));
        die();
    }

    public function getBillDetailByStatusIdAction($status_id)
    {
        $this->getBillDetailByStatusId($status_id);
        die();
    }

    public function generateCodeBillAction()
    {
        $this->generateCodeBill();
        die();
    }
    public function setBillClosedAction(){
        $this->setBillClosed($this->request->getQuery('bill_id'));
        die();
    }

    public function getTimeInTimeOutByBillIdAction($bill_id)
    {
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
        if ($this->request->isPost()) {
           // $this->createBill($this->request->getJsonRawBody());
            $this->createBill($this->request->getPost());
        } else {
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

        $this->updateTimeOut($this->request->getQuery('user_id'), $this->request->get('timeintimeout_id'));
        die();

    }

    public function updateQuantityAction()
    {
        $this->updateQuantity($this->request->getQuery('id_timeintimeout'), $this->request->get('quantity'));
        die();
    }

    public function updateProducerAction()
    {
        $this->updateProducer($this->request->getQuery('conveyor_id'), $this->request->get('bill_id'));
        die();
    }

    public function getAllConveyorAction()
    {
        $this->getAllConveyor();
        die();
    }

    public function loginAction()
    {
        if ($this->request->isPost()) {
            //$this->login($this->request->getJsonRawBody());
            $this->login($this->request->getPost());
        } else {
            $this->renderLog('Không tìm thấy phương thúc này');
        }
        die();
    }


}

