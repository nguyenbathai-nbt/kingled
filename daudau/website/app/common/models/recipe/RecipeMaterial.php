<?php


namespace Daudau\Common\Models\Recipe;


use Phalcon\Mvc\Model;

class RecipeMaterial extends Model
{
    protected $id;
    protected $recipe_cook_id;
    protected $raw_material_id;
    protected $quantitative_id;
    protected $number;
    protected $created_time;
    protected $modified_time;
    protected $status_id;

    public function initialize()
    {
        $this->hasOne('raw_material_id', 'Daudau\Common\Models\Recipe\RawMaterial', 'id', [
            'alias' => 'rawmaterial'
        ]);
        $this->hasOne('quantitative_id', 'Daudau\Common\Models\Recipe\Quantitative', 'id', [
            'alias' => 'quantitative'
        ]);
        $this->hasOne('recipe_cook_id', 'Daudau\Common\Models\Recipe\RecipeCook', 'id', [
            'alias' => 'recipe'
        ]);
    }

    public function getSource()
    {
        return "recipe_material";
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
    public function getRawMaterialId()
    {
        return $this->raw_material_id;
    }

    /**
     * @param mixed $raw_material_id
     */
    public function setRawMaterialId($raw_material_id)
    {
        $this->raw_material_id = $raw_material_id;
    }

    /**
     * @return mixed
     */
    public function getQuantitativeId()
    {
        return $this->quantitative_id;
    }

    /**
     * @param mixed $quantitative_id
     */
    public function setQuantitativeId($quantitative_id)
    {
        $this->quantitative_id = $quantitative_id;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
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
        $rs = $connection->query("select nextval('public.recipe_material_id_seq');");
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