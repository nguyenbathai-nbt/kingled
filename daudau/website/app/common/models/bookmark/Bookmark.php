<?php


namespace Daudau\Common\Models\Bookmark;


use Phalcon\Mvc\Model;

class Bookmark extends Model
{
    protected $id;
    protected $user_id;
    protected $recipe_cook_id;
    protected $status_id;
    protected $created_time;
    protected $modified_time;
    protected $bookmark_type; // type1: bookmark;  type2:favourite


    public function initialize()
    {
        $this->hasOne('user_id', 'Daudau\Common\Models\Users\Users', 'id', [
            'alias' => 'user'
        ]);
        $this->hasOne('recipe_cook_id', 'Daudau\Common\Models\Recipe\RecipeCook', 'id', [
            'alias' => 'recipe_cook'
        ]);


    }

    public function getSource()
    {
        return "bookmark";
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
    public function getRecipeCookId()
    {
        return $this->recipe_cook_id;
    }

    /**
     * @param mixed $recipe_cook_id
     */
    public function setRecipeCookId($recipe_cook_id)
    {
        $this->recipe_cook_id = $recipe_cook_id;
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

    /**
     * @return mixed
     */
    public function getBookmarkType()
    {
        return $this->bookmark_type;
    }

    /**
     * @param mixed $bookmark_type
     */
    public function setBookmarkType($bookmark_type)
    {
        $this->bookmark_type = $bookmark_type;
    }



    public function getSequenceId()
    {
        $connection = $this->getDI()->getShared("db");
        $rs = $connection->query("select nextval('public.bookmark_id_seq');");
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
        $code = self::findFirst([
            'conditions' => 'code=:code:',
            'bind' => [
                'code' => $post['code']
            ]
        ]);
        $name = self::findFirst([
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


}