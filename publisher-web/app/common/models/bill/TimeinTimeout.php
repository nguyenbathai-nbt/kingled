<?php


namespace Publisher\Common\Models\Bill;


use Phalcon\Di;
use Phalcon\Mvc\Model;

class TimeinTimeout extends Model
{
    protected $id;
    protected $bill_id;
    protected $product_id;
    protected $quantity;
    protected $time_in;
    protected $user_time_in;
    protected $time_out;
    protected $user_time_out;
    protected $major_id;
    protected $delay_status;
    protected $count_time;
    protected $parent_id;
    protected $description;
    protected $created_time;
    protected $modified_time;



    public function getSource()
    {
        return "timein_timeout";
    }
    public function initialize()
    {
        $this->hasOne('bill_id', 'Publisher\Common\Models\Bill\Bill', 'id', [
            'alias' => 'bill'
        ]);
        $this->hasOne('product_id', 'Publisher\Common\Models\Bill\Product', 'id', [
            'alias' => 'product'
        ]);
        $this->hasOne('major_id', 'Publisher\Common\Models\Bill\Major', 'id', [
            'alias' => 'major'
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
     * @param mixed $id
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
    public function getUserTimeIn()
    {
        return $this->user_time_in;
    }

    /**
     * @param mixed $user_time_in
     */
    public function setUserTimeIn($user_time_in)
    {
        $this->user_time_in = $user_time_in;
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
    public function getUserTimeOut()
    {
        return $this->user_time_out;
    }

    /**
     * @param mixed $user_time_out
     */
    public function setUserTimeOut($user_time_out)
    {
        $this->user_time_out = $user_time_out;
    }

    /**
     * @return mixed
     */
    public function getMajorId()
    {
        return $this->major_id;
    }

    /**
     * @param mixed $major_id
     */
    public function setMajorId($major_id)
    {
        $this->major_id = $major_id;
    }

    /**
     * @return mixed
     */
    public function getDelayStatus()
    {
        return $this->delay_status;
    }

    /**
     * @param mixed $delay_status
     */
    public function setDelayStatus($delay_status)
    {
        $this->delay_status = $delay_status;
    }

    /**
     * @return mixed
     */
    public function getCountTime()
    {
        return $this->count_time;
    }

    /**
     * @param mixed $count_time
     */
    public function setCountTime($count_time)
    {
        $this->count_time = $count_time;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
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
        $rs = $connection->query("select nextval('public.timein_timeout_id_seq');");
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
        $this->modified_time = date('Y-m-d G:i:s');
    }

}