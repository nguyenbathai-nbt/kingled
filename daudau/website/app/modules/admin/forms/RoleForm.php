<?php

namespace Daudau\Modules\Admin\Forms;


use Daudau\Common\Mvc\Form\Form;

class RoleForm extends Form
{
    public function initialize()
    {

    }

    public function search()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text'));
        $this->add(Form::addElement('code', 'Mã số', 'Text'));
    }

    public function create()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã số', 'Text', ['required' => true]));

    }

    public function edit()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã số', 'Text', ['required' => true]));

    }

    public function view()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('code', 'Mã số', 'Text', ['required' => true, 'readonly' => true]));

    }
}