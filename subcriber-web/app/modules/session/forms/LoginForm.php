<?php
namespace Subscriber\Modules\Session\Forms;

use Subscriber\Common\Mvc\CsrfForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\Email;
use Phalcon\Forms\Element\Check;
class LoginForm extends CsrfForm
{

    public function initialize()
    {
        parent::initialize();
        // Email
        $email = new Text('email', [
            'placeholder' => 'E-mail',
            'class' => 'form-control',
            'required'=>true
        ]);

        $email->addValidators([
            new PresenceOf([
                'message' => 'E-mail is required'
            ]),
            new Email([
                'message' => 'E-mail is not valid'
            ])
        ]);

        $this->add($email);

        // Password
        $password = new Password('password', [
            'placeholder' => 'Password',
            'class' => 'form-control'
        ]);

        $password->addValidator(new PresenceOf([
            'message' => 'Password is required'
        ]));

        $password->clear();

        $this->add($password);

        // Remember
        $remember = new Check('remember', [
            'value' => 'yes',
        ]);

        $remember->setLabel('Remember me');

        $this->add($remember);

    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                return "<div class='form-control-feedback text-danger'>". $message."</div>";
            }
        }
    }
}