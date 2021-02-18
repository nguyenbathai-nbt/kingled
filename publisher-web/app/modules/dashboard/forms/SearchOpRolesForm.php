<?php
namespace Publisher\Modules\Dashboard\Forms;


use Publisher\Common\Mvc\Form\Form;

class SearchOpRolesForm extends Form
{
    public function initialize()
    {
        $this->add(Form::addElement('name', 'Full Name', 'Text'));
        $this->add(Form::addElement('active', 'Active', 'Select',[], self::$listStatus));
    }
}