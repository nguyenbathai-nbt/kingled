<?php
namespace Subscriber\Common\Mvc;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\Identical;

class CsrfForm extends Form
{

    // Holds token key/name
    protected $_csrf;

    public function initialize()
    {

        // Some other elements...

        // CSRF protection
        $csrf = new Hidden($this->getCsrfName());
        $csrf->setDefault($this->security->getToken())
            ->addValidator(new Identical([
                'accepted' => $this->security->checkToken(),
                'message' => 'CSRF validation failed!'
            ]));
        $this->add($csrf);
    }

    // Generates CSRF token key
    public function getCsrfName()
    {
        if (empty($this->_csrf)) {
            $this->_csrf = $this->security->getTokenKey();
        }

        return $this->_csrf;
    }
}