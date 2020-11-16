<?php


namespace Daudau\Common\Models\Users;


use Phalcon\Mvc\Model;

class Status extends Model
{
    protected $id;
    protected $name;
    public $code;
    protected $created_time;
    protected $modified_time;

    public function initialize()
    {

    }

    public function getSource()
    {
        return "status_";
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
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
        $rs = $connection->query("select nextval('public.status_id_seq');");
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


    public static function checkValidations($post)
    {
        $code = Status::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => $post['code']
            ]
        ]);
        $name = Status::findFirst([
            'conditions' => 'name=:name:',
            'bind' => [
                'name' => $post['name']
            ]
        ]);

        $error = [];
        if ($code) {
            $error[] = 'Mã số đã tồn tại, vui lòng điền mã số khác';
        }
        if ($name) {
            $error[] = 'Tên đã tồn tại, vui lòng điền tên khác';
        }

        return $error;

    }

    public static function getStatusIdByCode($code)
    {
        $status = Status::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => $code
            ]
        ]);
        if ($status) {
            return $status->getId();
        } else {
            return null;
        }
    }

}