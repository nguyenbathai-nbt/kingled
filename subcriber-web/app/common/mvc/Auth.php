<?php

namespace Subscriber\Common\Mvc;

use Phalcon\Mvc\User\Component;
use Subscriber\Common\Models\Users\Users;

class Auth extends Component
{
    public function getIdentity()
    {
        return $this->session->get('auth-identity');
    }

    public function getUser()
    {
        $identity = $this->session->get('auth-identity');
        if (isset($identity['id'])) {

            $user = OpUsers::findFirstById($identity['id']);
            if ($user == false) {
                throw new AuthException('Invalid session, you must login!');
            }

            return $user;
        }

        return false;
    }

    public function authUserById($id)
    {
        // $user = OpUsers::findFirstById($id);
        $user = true;
        if ($user == false) {
            throw new AuthException('Invalid session, you must login!');
        }
        $this->session->set('auth-identity', [
            'id' => $user->getId(),
            'full_name' => $user->getUsername(),
            'role' => '1',
            'user_key' => $user->getUserKey(),
            'email'=>$user->getEmail()
        ]);
    }

    public function check($credentials)
    {

        // Check if the user exist
        $user = Users::findFirst([
            'conditions' => 'email=:email:  ',
            'bind' => [
                'email' => $credentials['email']
            ]
        ]);
        if ($user == false) {
            return 'Wrong email/password. Please try again';
        }

        // Check the password
        if (!$this->security->checkHash($credentials['password'], $user->password)) {
            return 'Wrong email/password. Please try again';
        }

        // Check if the user was flagged
        $this->checkUserFlags($user);

        // Register the successful login
        $this->saveSuccessLogin($user);

        // Check if the remember me was selected
        if (isset($credentials['remember'])) {
            $this->createRememberEnvironment($user);
        }

        $this->session->set('auth-identity', [
            'id' => $user->getId(),
            'full_name' => $user->getUsername(),
            'role' => '1',
            'user_key' => $user->getUserKey(),
            'email'=>$user->getEmail()
        ]);
        return 'true';
    }

    public function saveSuccessLogin($user)
    {

    }

    public function checkUserFlags($user)
    {

    }

    public function createRememberEnvironment($user)
    {

    }

    public function registerUserThrottling($user)
    {

    }

    public function isLoggedIn()
    {
        return is_array($this->session->get('auth-identity'));
    }
}