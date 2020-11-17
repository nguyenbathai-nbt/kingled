<?php


namespace Publisher\Common\Models\Users;


use Phalcon\Di;
use Phalcon\Mvc\Model;

class BillDetail extends Model
{
    protected $id;
    protected $bill_id;
    protected $product_id;
    protected $quantity;
    protected $description;
    protected $note;
    protected $time_in;
    protected $time_out;
    protected $created_time;
    protected $modified_time;




    public function getSource()
    {
        return "bill_detail";
    }
    public function initialize()
    {
        $this->hasOne('bill_id', 'Daudau\Common\Models\Bill\Bill', 'id', [
            'alias' => 'bill'
        ]);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id_
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getBillId()
    {
        return $this->bill_id;
    }

    /**
     * @param mixed $bill_id
     */
    public function setBillId($bill_id)
    {
        $this->bill_id = $bill_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getTimeIn()
    {
        return $this->time_in;
    }

    /**
     * @param mixed $time_in
     */
    public function setTimeIn($time_in)
    {
        $this->time_in = $time_in;
    }

    /**
     * @return mixed
     */
    public function getTimeOut()
    {
        return $this->time_out;
    }

    /**
     * @param mixed $time_out
     */
    public function setTimeOut($time_out)
    {
        $this->time_out = $time_out;
    }

    /**
     * @return mixed
     */
    public function getCreatedTime()
    {
        return $this->created_time;
    }

    /**
     * @param mixed $created_time
     */
    public function setCreatedTime($created_time)
    {
        $this->created_time = $created_time;
    }

    /**
     * @return mixed
     */
    public function getModifiedTime()
    {
        return $this->modified_time;
    }

    /**
     * @param mixed $modified_time
     */
    public function setModifiedTime($modified_time)
    {
        $this->modified_time = $modified_time;
    }


    public function getSequenceId()
    {
        $connection = $this->getDI()->getShared("db");
        $rs = $connection->query("select nextval('public.bill_detail_id_seq');");
        $sid = $rs->fetchAll();
        return $sid[0][0];
    }

    public function beforeValidationOnCreate()
    {
        $this->modified_time = date('Y-m-d G:i:s');
        $this->created_time = date('Y-m-d G:i:s');

    }

    public function beforeValidationOnUpdate()
    {
        $this->created_time = date('Y-m-d G:i:s');
        $this->modified_time = date('Y-m-d G:i:s');
    }



}