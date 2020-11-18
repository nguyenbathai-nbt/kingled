<?php

namespace Daudau\Modules\Admin\Forms;


use Daudau\Common\Mvc\Form\Form;

class CommentForm extends Form
{
    public function initialize()
    {

    }

    public function search()
    {
        $this->add(Form::addElement('name', 'Name', 'Text'));
        $this->add(Form::addElement('code', 'Code', 'Text'));
    }

    public function create()
    {
        $this->add(Form::addElement('name', 'Name', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Code', 'Text', ['required' => true]));

    }

    public function edit()
    {
        $this->add(Form::addElement('name', 'Name', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Code', 'Text', ['required' => true]));

    }

    public function view()
    {
        $this->add(Form::addElement('name', 'Name', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('code', 'Code', 'Text', ['required' => true, 'readonly' => true]));

    }
}