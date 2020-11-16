<?php


namespace Subscriber\Modules\Dashboard\Forms;


use CoursemosCloud\Common\Models\Customer\CustRoles;
use CoursemosCloud\Common\Mvc\Form\Form;

class CreateOpRolesForm extends Form
{

    public function initialize()
    {
        $this->add(Form::addElement('name', 'Role name', 'Text',['required'=>true]));
        $this->add(Form::addElement('description', 'Description', 'Text'));
        $this->add(Form::addElement('active', 'Active', 'Select',['required'=>true], self::$listStatus));
    }
}