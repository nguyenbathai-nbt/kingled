<?php


namespace Daudau\Modules\Admin\Forms;


use Daudau\Common\Models\Users\Status;
use Daudau\Common\Mvc\Form\Form;

class QuantitativeForm extends Form
{

    public function initialize()
    {

    }

    public function search()
    {

    }

    public function view()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('code   ', 'Mã số', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('short_code', 'Mã rút gọn', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'disabled' => true, 'date-type' => 'select2', 'using' => ['id', 'name']], Status::find()));
    }

    public function edit()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true]));
        $this->add(Form::addElement('code   ', 'Mã số', 'Text', ['required' => true]));
        $this->add(Form::addElement('short_code', 'Mã rút gọn', 'Text', ['required' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'date-type' => 'select2', 'using' => ['id', 'name']], Status::find()));


    }

    public function create()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text', ['required' => true]));
        $this->add(Form::addElement('code   ', 'Mã số', 'Text', ['required' => true]));
        $this->add(Form::addElement('short_code', 'Mã rút gọn', 'Text', ['required' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'date-type' => 'select2', 'using' => ['id', 'name']], Status::find()));

    }

    public function delete()
    {

    }
}