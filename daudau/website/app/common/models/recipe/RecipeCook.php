<?php


namespace Daudau\Common\Models\Recipe;


use Daudau\Common\Models\Bookmark\Bookmark;
use Daudau\Common\Models\Users\Status;
use Phalcon\Mvc\Model;

class RecipeCook extends Model
{
    protected $id;
    public $name;
    protected $code;
    protected $bookmark_total;
    protected $status_id;
    protected $image_id;
    protected $user_id;
    protected $created_time;
    protected $modified_time;
    protected $level;
    protected $time_do;
    protected $description;
    protected $seen_total;
    protected $link_video;
    protected $link_share;

    public function initialize()
    {
        $this->hasOne('image_id', 'Daudau\Common\Models\Recipe\Image', 'id', [
            'alias' => 'image'
        ]);
        $this->hasOne('user_id', 'Daudau\Common\Models\Users\Users', 'id', [
            'alias' => 'user'
        ]);
        $this->hasOne('status_id', 'Daudau\Common\Models\Users\Status', 'id', [
            'alias' => 'status'
        ]);
    }

    public function getSource()
    {
        return "recipe_cook";
    }

    /**
     * @return mixed
     */
    public function getLinkShare()
    {
        return $this->link_share;
    }

    /**
     * @param mixed $link_share
     */
    public function setLinkShare($link_share)
    {
        $this->link_share = $link_share;
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
    public function getBookmarkTotal()
    {
        return $this->bookmark_total;
    }

    /**
     * @param mixed $bookmark_total
     */
    public function setBookmarkTotal($bookmark_total)
    {
        $this->bookmark_total = $bookmark_total;
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
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getTimeDo()
    {
        return $this->time_do;
    }

    /**
     * @param mixed $time_do
     */
    public function setTimeDo($time_do)
    {
        $this->time_do = $time_do;
    }

    /**
     * @return mixed
     */
    public function getSeenTotal()
    {
        return $this->seen_total;
    }

    /**
     * @param mixed $seen_total
     */
    public function setSeenTotal($seen_total)
    {
        $this->seen_total = $seen_total;
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
    public function getLinkVideo()
    {
        return $this->link_video;
    }

    /**
     * @param mixed $link_video
     */
    public function setLinkVideo($link_video)
    {
        $this->link_video = $link_video;
    }




    public function getSequenceId()
    {
        $connection = $this->getDI()->getShared("db");
        $rs = $connection->query("select nextval('public.recipe_cook_id_seq');");
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

    public static function getTotalSeenRecipe($id)
    {
        $total = SeenRecipe::count([
            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $id
            ]
        ]);
        return $total;

    }

    public static function checkbookmarkRecipe($user_id, $recipe_cook_id)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $check = Bookmark::findFirst([
            'conditions' => 'recipe_cook_id=:recipe_cook_id: and user_id=:user_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
            'bind' => [
                'recipe_cook_id' => $recipe_cook_id,
                'user_id' => $user_id,
                'status_id' => $status_id_enable,
                'bookmark_type' => 'favourite'

            ]
        ]);
        if ($check) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public static function totalSeemRecipe($recipe_cook_id)
    {
        $total = SeenRecipe::count([
            'conditions' => 'recipe_cook_id=:recipe_cook_id:',
            'bind' => [
                'recipe_cook_id' => $recipe_cook_id
            ]
        ]);
        return $total;
    }

    public static function checkFavouriteRecipe($user_id, $recipe_cook_id)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');

        $check = Bookmark::findFirst([
            'conditions' => 'user_id=:user_id: and recipe_cook_id=:recipe_cook_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
            'bind' => [
                'user_id' => $user_id,
                'status_id' => $status_id_enable,
                'bookmark_type' => 'favourite',
                'recipe_cook_id' => $recipe_cook_id
            ]
        ]);
        if ($check) {
            return 'true';
        } else {
            return 'false';
        }
    }


}