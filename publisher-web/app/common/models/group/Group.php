<?php

namespace Publisher\Common\Models\Group;

use Phalcon\Mvc\Model;

class Group extends Model
{

    protected $id_;
    protected $group_code;
    protected $owner_id;
    protected $description;
    protected $api_key;
    protected $default_url;
    protected $group_name;
    protected $group_url;
    protected $group_email;
    protected $status_;
    protected $created_date;
    protected $modified_date;


    public function initialize()
    {

        $this->hasOne('id_', 'Publisher\Common\Models\Badge\BadgeTemplate', 'group_id', [
            'alias' => 'badgetemplate'
        ]);
    }

    public function getSource()
    {
        return "group_";
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
    public function getGroupCode()
    {
        return $this->group_code;
    }

    /**
     * @param mixed $group_code
     */
    public function setGroupCode($group_code)
    {
        $this->group_code = $group_code;
    }

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * @param mixed $owner_id
     */
    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
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
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @param mixed $api_key
     */
    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * @return mixed
     */
    public function getDefaultUrl()
    {
        return $this->default_url;
    }

    /**
     * @param mixed $default_url
     */
    public function setDefaultUrl($default_url)
    {
        $this->default_url = $default_url;
    }

    /**
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * @param mixed $group_name
     */
    public function setGroupName($group_name)
    {
        $this->group_name = $group_name;
    }

    /**
     * @return mixed
     */
    public function getGroupUrl()
    {
        return $this->group_url;
    }

    /**
     * @param mixed $group_url
     */
    public function setGroupUrl($group_url)
    {
        $this->group_url = $group_url;
    }

    /**
     * @return mixed
     */
    public function getGroupEmail()
    {
        return $this->group_email;
    }

    /**
     * @param mixed $group_email
     */
    public function setGroupEmail($group_email)
    {
        $this->group_email = $group_email;
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


    public function getSequenceId()
    {
        $connection = $this->getDI()->getShared("db");
        $rs = $connection->query("select nextval('public.group_id_seq');");
        $sid = $rs->fetchAll();
        return $sid[0][0];
    }

    public function beforeValidationOnCreate()
    {
        $this->modified_date = date('Y-m-d G:i:s');
        $this->created_date = date('Y-m-d G:i:s');
        $time = date('G:i:s');
        $parsed = date_parse($time);
        $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
        $groupnamehash = str_replace(' ', '_', trim($this->group_name));
        $timehash = date('Ymd') . $seconds;
        $this->group_code = $groupnamehash . '_' . $timehash;

    }

    public function beforeValidationOnUpdate()
    {
        $this->modified_date = date('Y-m-d G:i:s');
    }


}