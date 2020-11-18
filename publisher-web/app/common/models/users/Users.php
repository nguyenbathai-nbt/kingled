<?php


namespace Publisher\Common\Models\Users;


use Phalcon\Di;
use Phalcon\Mvc\Model;

class Users extends Model
{
    protected $id;
    protected $username;
    protected $password;
    protected $role_id;
    protected $created_time;
    protected $modified_time;
    protected $status_id;



    public function getSource()
    {
        return "user";
    }
    public function initialize()
    {
        $this->hasOne('role_id', 'Publisher\Common\Models\Users\Role', 'id', [
            'alias' => 'role'
        ]);
        $this->hasOne('status_id', 'Publisher\Common\Models\Users\Status', 'id', [
            'alias' => 'status'
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
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


    public function getSequenceId()
    {
        $connection = $this->getDI()->getShared("db");
        $rs = $connection->query("select nextval('public.user_id_seq');");
        $sid = $rs->fetchAll();
        return $sid[0][0];
    }

    public function beforeValidationOnCreate()
    {

        $this->password = $this->getDI()
            ->getSecurity()
            ->hash($this->password);
        $this->modified_time = date('Y-m-d G:i:s');
        $this->created_time = date('Y-m-d G:i:s');

    }

    public function beforeValidationOnUpdate()
    {
        $this->modified_time = date('Y-m-d G:i:s');
    }

    public static function checkEmailExists($email)
    {
        $user = Product::findFirst([
            'conditions' => 'email=:email:',
            'bind' => [
                'email' => $email
            ]
        ]);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkValidations($post)
    {

        $username = self::findFirst([
            'conditions' => 'username=:username:',
            'bind' => [
                'username' => $post['username']
            ]
        ]);

        $error = [];

        if ($username) {
            $error[] = 'The username is already registered';
        }

        return $error;

    }

    public static function changePassword($id, $password)
    {
        $user = self::findFirst([
            'conditions' => 'id_=:id_:',
            'bind' => [
                'id_' => $id
            ]
        ]);
        if ($user) {
            $user->setPassword(Di::getDefault()->getSecurity()->hash($password));
            if ($user->save()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}