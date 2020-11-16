<?php
namespace Daudau\Modules\Admin\Forms;

use Daudau\Common\Mvc\CsrfForm;
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
        $email = new Text('username', [
            'placeholder' => 'Tên đăng nhập',
            'class' => 'form-control',
            'required'=>true
        ]);

        $email->addValidators([
            new PresenceOf([
                'message' => 'Tên đăng nhập là bắt buộc'
            ])
        ]);

        $this->add($email);

        // Password
        $password = new Password('password', [
            'placeholder' => 'Mật khẩu',
            'class' => 'form-control'
        ]);

        $password->addValidator(new PresenceOf([
            'message' => 'Mật khẩu là bắt buộc'
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