<?php


namespace Daudau\Common\Models\Users;


use Phalcon\Mvc\Model;

class Role extends Model
{
    protected $id;
    protected $name;
    public $code;
    protected $created_time;
    protected $modified_time;
    protected $status_id;

    public function initialize()
    {

    }

    public function getSource()
    {
        return "role_";
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
    public function getStatusId()
    {
        return $this->status_id;
    }

    /**
     * @param mixed $status_id
     */
    public function setStatusId($status_id)
    {
        $this->status_id = $status_id;
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
        $rs = $connection->query("select nextval('public.role_id_seq');");
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

    public static function getIdByCode($code)
    {
        $role = Role::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => $code
            ]
        ]);

        return $role->getId();
    }

    public static function checkValidations($post)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');

        $code = self::findFirst([
            'conditions' => 'code=:code: and status_id=:status_id:',
            'bind' => [
                'code' => $post['code'],
                'status_id' => $status_id_enable
            ]
        ]);
        $name = self::findFirst([
            'conditions' => 'name=:name: and status_id=:status_id:',
            'bind' => [
                'name' => $post['name'],
                'status_id' => $status_id_enable
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


}