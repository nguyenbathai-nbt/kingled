<?php

namespace Daudau\Modules\Admin\Forms;


use Daudau\Common\Models\Users\Role;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Mvc\Form\Form;

class UserForm extends Form
{
    public function initialize()
    {

    }

    public function search()
    {
        $this->add(Form::addElement('name', 'Tên', 'Text'));
        $this->add(Form::addElement('active', 'Active', 'Select', [], self::$listStatus));
    }

    public function edit()
    {
        $this->add(Form::addElement('username', 'Tên đăng nhấp', 'Text', ['required' => true]));
        $this->add(Form::addElement('email', 'E-mail', 'Text', ['required' => true]));
        $this->add(Form::addElement('phone', 'Số điện thoại', 'Text', ['required' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'date-type' => 'select2', 'using' => ['id', 'name']], Status::find()));
        $this->add(Form::addElement('role_id', 'Quyền', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], Role::find()));
    }

    public function view()
    {
        $this->add(Form::addElement('username', 'Tên đăng nhập', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('email', 'E-mail', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('phone', 'Số điện thoại', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'date-type' => 'select2', 'using' => ['id', 'name'], 'disabled' => true], Status::find()));
        $this->add(Form::addElement('role_id', 'Quyền', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name'], 'disabled' => true], Role::find()));

    }

    public function create()
    {
        $this->add(Form::addElement('username', 'Tên đăng nhập', 'Text', ['required' => true]));
        $this->add(Form::addElement('email', 'E-mail', 'Text', ['required' => true]));
        $this->add(Form::addElement('phone', 'Số điện thoại', 'Text', ['required' => true]));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'date-type' => 'select2', 'using' => ['id', 'name']], Status::find()));
        $this->add(Form::addElement('role_id', 'Quyền', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], Role::find()));

    }
}