<?php


namespace Daudau\Common\Models\Users;


use Daudau\Common\Models\Bookmark\BookmarkUser;
use Daudau\Common\Models\Recipe\RecipeCook;
use Phalcon\Mvc\Model;

class Users extends Model
{
    protected $id;
    public $username;
    protected $password;
    protected $email;
    protected $phone;
    protected $status_id;
    protected $token;
    protected $role_id;
    protected $created_time;
    protected $modified_time;
    protected $image_id;

    public function initialize()
    {
        $this->hasOne('role_id', 'Daudau\Common\Models\Users\Role', 'id', [
            'alias' => 'role'
        ]);
        $this->hasOne('status_id', 'Daudau\Common\Models\Users\Status', 'id', [
            'alias' => 'status'
        ]);
        $this->hasOne('image_id', 'Daudau\Common\Models\Recipe\Image', 'id', [
            'alias' => 'image'
        ]);
    }

    public function getSource()
    {
        return "user_";
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
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
    public function getImageId()
    {
        return $this->image_id;
    }

    /**
     * @param mixed $image_id
     */
    public function setImageId($image_id)
    {
        $this->image_id = $image_id;
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


    public static function checkValidations($post)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $email = self::findFirst([
            'conditions' => 'email=:email: and status_id=:status_id:',
            'bind' => [
                'email' => $post['email'],
                'status_id' => $status_id_enable
            ]
        ]);
        $username = self::findFirst([
            'conditions' => 'username=:username: and status_id=:status_id:',
            'bind' => [
                'username' => $post['username'],
                'status_id' => $status_id_enable
            ]
        ]);

        $error = [];
        if ($email) {
            $error[] = 'E-mail đã tồn tại, vui lòng điền E-mail khác';
        }
        if ($username) {
            $error[] = 'Tên đăng nhập đã tồn tại, vui lòng điền tên đăng nhập khác';
        }

        return $error;

    }

    public static function getTotalRecipe($id)
    {
        $total = RecipeCook::count([
            'conditions' => 'user_id=:user_id:',
            'bind' => [
                'user_id' => $id
            ]
        ]);
        return $total;
    }

    public static function getTotalBookmarkUser($id)
    {
        $total = BookmarkUser::count([
            'conditions' => 'user_id=:user_id: and type=:type:',
            'bind' => [
                'user_id' => $id,
                'type'=>'bookmark_user'
            ]
        ]);
        return $total;
    }

    public static function getTotalUserBookmark($id)
    {
        $total = BookmarkUser::count([
            'conditions' => 'bookmark_user_id=:bookmark_user_id: and type=:type:',
            'bind' => [
                'bookmark_user_id' => $id,
                'type'=>'bookmark_user'
            ]
        ]);
        return $total;
    }

}