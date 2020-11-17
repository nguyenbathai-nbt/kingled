<?php


namespace Publisher\Modules\Issuer\Forms;


use Publisher\Common\Mvc\Form\Form;

class IssuedForm extends Form
{
    public function initialize()
    {

    }

    public function createissuer()
    {
        $this->add(Form::addElement('username', 'Username', 'Text', ['required' => true]));
        $this->add(Form::addElement('password', 'Password', 'Password', ['required' => true]));
        $this->add(Form::addElement('email', 'Email', 'Email', ['required' => true]));


    }

    public function changepassword()
    {
        $this->add(Form::addElement('new_password', 'Mật khẩu mới', 'Password'));
        $this->add(Form::addElement('confirm_password', 'Xác nhận mật khẩu', 'Password'));
    }

    public function viewissuer()
    {
        $this->add(Form::addElement('username', 'Username', 'Text', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('password', 'Password', 'Password', ['required' => true, 'readonly' => true]));
        $this->add(Form::addElement('email', 'Email', 'Email', ['required' => true, 'readonly' => true]));

    }

}