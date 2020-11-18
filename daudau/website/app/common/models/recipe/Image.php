<?php


namespace Daudau\Common\Models\Recipe;


use Phalcon\Mvc\Model;

class Image extends Model
{
    protected $id;
    protected $code;
    public $image_base;
    protected $created_time;
    protected $modified_time;
    protected $image_url;
    protected $image_url_resize;
    protected $count_step;
    protected $step_id;
    protected $recipe_cook_id;
    protected $status_id;


    public function initialize()
    {

    }

    public function getSource()
    {
        return "image";
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
    public function getCountStep()
    {
        return $this->count_step;
    }

    /**
     * @param mixed $count_step
     */
    public function setCountStep($count_step)
    {
        $this->count_step = $count_step;
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
    public function getImageBase()
    {
        return $this->image_base;
    }

    /**
     * @param mixed $image_base
     */
    public function setImageBase($image_base)
    {
        $this->image_base = $image_base;
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
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * @param mixed $image_url
     */
    public function setImageUrl($image_url)
    {
        $this->image_url = $image_url;
    }

    /**
     * @return mixed
     */
    public function getImageUrlResize()
    {
        return $this->image_url_resize;
    }

    /**
     * @param mixed $image_url_resize
     */
    public function setImageUrlResize($image_url_resize)
    {
        $this->image_url_resize = $image_url_resize;
    }

    /**
     * @return mixed
     */
    public function getStepId()
    {
        return $this->step_id;
    }

    /**
     * @param mixed $step_id
     */
    public function setStepId($step_id)
    {
        $this->step_id = $step_id;
    }

    /**
     * @return mixed
     */

    public function getSequenceId()
    {
        $connection = $this->getDI()->getShared("db");
        $rs = $connection->query("select nextval('public.image_id_seq');");
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