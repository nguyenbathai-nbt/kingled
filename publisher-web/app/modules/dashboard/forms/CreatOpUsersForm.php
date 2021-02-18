<?php


namespace Publisher\Modules\Dashboard\Forms;


use CoursemosCloud\Common\Models\Customer\CustRoles;
use CoursemosCloud\Common\Models\Opteam\OpRoles;
use CoursemosCloud\Common\Mvc\Form\Form;

class CreatOpUsersForm extends Form
{

    public function initialize()
    {
        $this->add(Form::addElement('full_name', 'Full name', 'Text',['required'=>true]));
        $this->add(Form::addElement('email', 'Email', 'Email',['required'=>true]));
        $this->add(Form::addElement('role', 'Role', 'Select',['data-type'=>'select2','required'=>true,'using'=>['id','name']],OpRoles::find()));
        $this->add(Form::addElement('phone', 'Phone', 'Number',['required'=>true]));
        $this->add(Form::addElement('password', 'Password', 'Password',['required'=>true]));
        $this->add(Form::addElement('active', 'Active', 'Select',['required'=>true], self::$listStatus));
        $this->add(Form::addElement('banned', 'Banned', 'Select',['required'=>true], self::$listStatus));
        $this->add(Form::addElement('suspend', 'Suspend', 'Select',['required'=>true], self::$listStatus));


    }
}