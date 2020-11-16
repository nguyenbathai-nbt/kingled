<?php

namespace Publisher\Common\Models\Badge;

use Phalcon\Mvc\Model;

class BadgeTemplate extends Model
{

    protected $id_;
    public $image;
    protected $created_date;
    protected $modified_date;
    protected $status_;
    protected $group_id;
    public $image_type;


    public function initialize()
    {

    }

    public function getSource()
    {
         return "badge_template";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id_ = $id;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * @param mixed $created_date
     */
    public function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
    }

    /**
     * @return mixed
     */
    public function getModifiedDate()
    {
        return $this->modified_date;
    }

    /**
     * @param mixed $modified_date
     */
    public function setModifiedDate($modified_date)
    {
        $this->modified_date = $modified_date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status_;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status_ = $status;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * @param mixed $group_id
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    /**
     * @return mixed
     */
    public function getImageType()
    {
        return $this->image_type;
    }

    /**
     * @param mixed $image_type
     */
    public function setImageType($image_type)
    {
        $this->image_type = $image_type;
    }

    public function beforeValidationOnCreate()
    {
        $this->modified_date = date('Y-m-d G:i:s');
        $this->created_date = date('Y-m-d G:i:s');

    }

    public function beforeValidationOnUpdate()
    {
        $this->modified_date = date('Y-m-d G:i:s');
    }

    public function getSequenceId()
    {
        $connection = $this->getDI()->getShared("db");
        $rs = $connection->query("select nextval('public.badge_template_id_seq');");
        $sid = $rs->fetchAll();
        return $sid[0][0];
    }

}