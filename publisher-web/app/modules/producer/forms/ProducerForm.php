<?php


namespace Publisher\Modules\Producer\Forms;


use Publisher\Common\Mvc\Form\Form;

class ProducerForm extends Form
{
    public function initialize()
    {

    }

    public function createconveyor()
    {
        $this->add(Form::addElement('name', 'Tên chuyền', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã', 'Text', ['required' => true]));

    }

    public function editconveyor()
    {
        $this->add(Form::addElement('name', 'Tên chuyền', 'Text', ['required' => true]));
        $this->add(Form::addElement('code', 'Mã', 'Text', ['required' => true]));
    }
    
}