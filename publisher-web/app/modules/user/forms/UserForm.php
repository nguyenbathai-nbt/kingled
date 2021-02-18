<?php


namespace Publisher\Modules\User\Forms;


use Publisher\Common\Models\Users\Role;
use Publisher\Common\Models\Users\Status;
use Publisher\Common\Mvc\Form\Form;

class UserForm extends Form
{
    public function initialize()
    {

    }

    public function createuser()
    {
        $this->add(Form::addElement('username', 'Tên người dùng', 'Text', ['required' => true]));
        $this->add(Form::addElement('role_id', 'Quyền', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], Role::find()));
        $this->add(Form::addElement('status_id', 'Trạng thái', 'Select', ['required' => true, 'data-type' => 'select2', 'using' => ['id', 'name']], Status::find()));


    }

    public function editgroup()
    {
        $this->add(Form::addElement('group_name', 'Group name', 'Text', ['required' => true]));
        $this->add(Form::addElement('import', 'Upload image', 'File', ['validations' => ['file' => ['extension' => 'xls']]]));
        $this->add(Form::addElement('description', 'Description', 'Text', ['required' => true]));
        $this->add(Form::addElement('default_url', 'Default url', 'Text', ['required' => true, 'validations' => ['pattern' => ['regexp' => '^(https?|http)://[^\s/$.?#].[^\s]*[^.]$', 'message' => 'The site name must in a-z, A-Z, 0-9.']]]));
    }

    public function searchRecipient()
    {

    }

}