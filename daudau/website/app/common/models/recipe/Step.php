<?php


namespace Daudau\Common\Models\Recipe;


use Phalcon\Mvc\Model;

class Step extends Model
{
    protected $id;
    protected $name;
    protected $code;
    protected $count;
    protected $recipe_cook_id;
    protected $image_id;
    protected $description;
    protected $created_time;
    protected $modified_time;
    protected $status_id;

    public function initialize()
    {

    }

    public function getSource()
    {
        return "step";
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
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
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
        $rs = $connection->query("select nextval('public.step_id_seq');");
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