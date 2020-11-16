<?php


namespace Daudau\Common\Models\Bookmark;


use Daudau\Common\Models\Recipe\RecipeCook;
use Phalcon\Mvc\Model;

class BookmarkUser extends Model
{
    protected $id;
    protected $user_id;
    protected $bookmark_user_id;
    protected $status_id;
    protected $created_time;
    protected $modified_time;
    protected $type;  // bookmark_user or rating
    protected $point;


    public function initialize()
    {
        $this->hasOne('user_id', 'Daudau\Common\Models\Users\Users', 'id', [
            'alias' => 'user'
        ]);
        $this->hasOne('bookmark_user_id', 'Daudau\Common\Models\Users\Users', 'id', [
            'alias' => 'bookmark_user'
        ]);
    }

    public function getSource()
    {
        return "bookmark_user";
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
    public function getBookmarkUserId()
    {
        return $this->bookmark_user_id;
    }

    /**
     * @param mixed $bookmark_user_id
     */
    public function setBookmarkUserId($bookmark_user_id)
    {
        $this->bookmark_user_id = $bookmark_user_id;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param mixed $point
     */
    public function setPoint($point)
    {
        $this->point = $point;
    }


    public function getSequenceId()
    {
        $connection = $this->getDI()->getShared("db");
        $rs = $connection->query("select nextval('public.bookmark_user_id_seq');");
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
        $total= BookmarkUser::count([
            'conditions'=>'user_id=:user_id: and type=:type: ',
            'bind'=>[
                'user_id'=>$id,
                'type'=>'bookmark_user',

            ]
        ]);
        return $total;
    }


}