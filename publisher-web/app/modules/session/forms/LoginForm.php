<?php
namespace Publisher\Modules\Session\Forms;

use Publisher\Common\Mvc\CsrfForm;
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
        $username = new Text('username', [
            'placeholder' => 'Username',
            'class' => 'form-control',
            'required'=>true
        ]);

        $this->add($username);

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