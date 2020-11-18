<?php


namespace Daudau\Common\Models\Users;


use Daudau\Common\Models\Bookmark\BookmarkUser;
use Daudau\Common\Models\Recipe\RecipeCook;
use Phalcon\Mvc\Model;

class UsersCategory extends Model
{
    protected $id;
    protected $user_id;
    protected $category_id;
    protected $status_id;
    protected $created_time;
    protected $modified_time;

    public function initialize()
    {
        $this->hasOne('category_id', 'Daudau\Common\Models\Bookmark\Category', 'id', [
            'alias' => 'category'
        ]);
    }

    public function getSource()
    {
        return "user_category";
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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
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
        $rs = $connection->query("select nextval('public.user_category_id_seq');");
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