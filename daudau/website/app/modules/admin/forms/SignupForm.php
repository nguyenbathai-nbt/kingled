<?php
namespace Daudau\Modules\Admin\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Validation\Validator\Email as EmailValidation;
use Phalcon\Validation\Validator\PresenceOf;
use Daudau\Common\Mvc\CsrfForm;
use Daudau\Common\Mvc\Form\Form;

class SignUpForm extends CsrfForm
{

    public function initialize()
    {
        $username = new Text('username', [
            'placeholder' => 'Tên đăng nhập',
            'class' => 'form-control',
            'required'=>true
        ]);

        $username->addValidators([
            new PresenceOf([
                'message' => 'Tên đăng nhập là bắt buộc'
            ])
        ]);

        $this->add($username);


        $re_password = new Password('re_password', [
            'placeholder' => 'Nhắc lại mật khẩu',
            'class' => 'form-control',
            'required'=>true
        ]);

        $re_password->addValidator(new PresenceOf([
            'message' => 'Nhắc lại mật khẩu là bắt buộc'
        ]));

        $re_password->clear();

        $this->add($re_password);


        $password = new Password('password', [
            'placeholder' => 'Mật khẩu',
            'class' => 'form-control',
            'required'=>true
        ]);

        $password->addValidator(new PresenceOf([
            'message' => 'Mật khẩu là bắt buộc'
        ]));

        $password->clear();

        $this->add($password);


        $email = new Email('email', [
            'placeholder' => 'E-mail',
            'class' => 'form-control',
            'required'=>true,

        ]);

        $email->addValidators([
            new PresenceOf([
                'message' => 'E-mail là bắt buộc'
            ]),
            new EmailValidation([
                'message' => 'E-mail không hợp lệ'
            ])
        ]);

        $this->add($email);

    }



}