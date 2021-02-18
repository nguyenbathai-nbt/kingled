<?php


namespace Publisher\Modules\Dashboard\Forms;


use Publisher\Common\Mvc\Form\Form;

class SearchOpUsersForm extends Form
{

    public function initialize()
    {
        $this->add(Form::addElement('full_name', 'Full Name', 'Text'));
        $this->add(Form::addElement('email', 'Email', 'Email'));
        $this->add(Form::addElement('role', 'Role', 'Text'));
        $this->add(Form::addElement('phone', 'Phone', 'Number'));
        $this->add(Form::addElement('active', 'Active', 'Select',[], self::$listStatus));
    }
}