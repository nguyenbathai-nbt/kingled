<?php


namespace Subscriber\Common\Models\Users;


use Phalcon\Mvc\Model;

class Users extends Model
{
    protected $id_;
    protected $username;
    protected $password;
    protected $email;
    protected $created_date;
    protected $modified_date;
    protected $enable_mfa;
    protected $secret_mfa;
    protected $status_;
    protected $last_passwd_update;
    protected $last_login;
    protected $last_fail_attempt;
    protected $role;
    protected $user_key;


    public function getSource()
    {
        return "user_";
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getEnableMfa()
    {
        return $this->enable_mfa;
    }

    /**
     * @param mixed $enable_mfa
     */
    public function setEnableMfa($enable_mfa)
    {
        $this->enable_mfa = $enable_mfa;
    }

    /**
     * @return mixed
     */
    public function getSecretMfa()
    {
        return $this->secret_mfa;
    }

    /**
     * @param mixed $secret_mfa
     */
    public function setSecretMfa($secret_mfa)
    {
        $this->secret_mfa = $secret_mfa;
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
    public function getLastPasswdUpdate()
    {
        return $this->last_passwd_update;
    }

    /**
     * @param mixed $last_passwd_update
     */
    public function setLastPasswdUpdate($last_passwd_update)
    {
        $this->last_passwd_update = $last_passwd_update;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * @param mixed $last_login
     */
    public function setLastLogin($last_login)
    {
        $this->last_login = $last_login;
    }

    /**
     * @return mixed
     */
    public function getLastFailAttempt()
    {
        return $this->last_fail_attempt;
    }

    /**
     * @param mixed $last_fail_attempt
     */
    public function setLastFailAttempt($last_fail_attempt)
    {
        $this->last_fail_attempt = $last_fail_attempt;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getUserKey()
    {
        return $this->user_key;
    }

    /**
     * @param mixed $user_key
     */
    public function setUserKey($user_key)
    {
        $this->user_key = $user_key;
    }


    public function initialize()
    {

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
        $this->modified_date = date('Y-m-d G:i:s');
        $this->created_date = date('Y-m-d G:i:s');

    }

    public function beforeValidationOnUpdate()
    {
        $this->modified_date = date('Y-m-d G:i:s');
    }

    public static function checkEmailExists($email)
    {
        $user = Users::findFirst([
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
        $email = self::findFirst([
            'conditions' => 'email=:email:',
            'bind' => [
                'email' => $post['email']
            ]
        ]);
        $username = self::findFirst([
            'conditions' => 'username=:username:',
            'bind' => [
                'username' => $post['username']
            ]
        ]);

        $error = [];
        if ($email) {
            $error[] = 'The email is already registered';
        }
        if ($username) {
            $error[] = 'The username is already registered';
        }

        return $error;

    }

}