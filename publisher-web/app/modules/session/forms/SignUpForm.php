<?php
namespace Publisher\Modules\Session\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Validation\Validator\Email as EmailValidation;
use Phalcon\Validation\Validator\PresenceOf;
use Publisher\Common\Mvc\CsrfForm;
use Publisher\Common\Mvc\Form\Form;

class SignUpForm extends CsrfForm
{

    public function initialize()
    {
        $username = new Text('username', [
            'placeholder' => 'Username',
            'class' => 'form-control',
            'required'=>true
        ]);

        $username->addValidators([
            new PresenceOf([
                'message' => 'E-mail is required'
            ])
        ]);

        $this->add($username);


        $re_password = new Password('re_password', [
            'placeholder' => 'Re-password',
            'class' => 'form-control',
            'required'=>true
        ]);

        $re_password->addValidator(new PresenceOf([
            'message' => 'Password is required'
        ]));

        $re_password->clear();

        $this->add($re_password);


        $password = new Password('password', [
            'placeholder' => 'Password',
            'class' => 'form-control',
            'required'=>true
        ]);

        $password->addValidator(new PresenceOf([
            'message' => 'Password is required'
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
                'message' => 'E-mail is required'
            ]),
            new EmailValidation([
                'message' => 'E-mail is not valid'
            ])
        ]);

        $this->add($email);

    }



}