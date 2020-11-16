<?php


namespace Daudau\Modules\Session\Forms;


use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\Email;
use Phalcon\Forms\Element\Submit;
class ForgotPasswordForm extends Form
{
    public function initialize()
    {
        $email = new Text('email', [
            'placeholder' => 'Email',
            'class' => 'form-control'
        ]);
        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ]),
            new Email([
                'message' => 'The e-mail is not valid'
            ])
        ]);
        $this->add($email);
        $this->add(new Submit('Send', [
            'class' => 'btn btn-primary'
        ]));
    }
}