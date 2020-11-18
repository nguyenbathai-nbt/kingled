<?php


namespace Publisher\Common\Models\Bill;


use Phalcon\Di;
use Phalcon\Mvc\Model;

class Product extends Model
{
    protected $id;
    protected $name;
    protected $code;
    protected $description;
    protected $created_time;
    protected $modified_time;



    public function getSource()
    {
        return "product";
    }
    public function initialize()
    {

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
        $rs = $connection->query("select nextval('public.product_id_seq');");
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