<?php

namespace Daudau\Modules\Api\Controllers;

use Daudau\Modules\Api\Rest\RestLoginController;

class LoginController extends RestLoginController
{

    public function loginAction()
    {
        $this->getLogin();
        die();
    }

    public function signUpAction()
    {
        $this->getSignUp();
        die();
    }

}

