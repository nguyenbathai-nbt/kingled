<?php

namespace Daudau\Common\Mvc;

use Daudau\Common\Models\Users\Status;
use Daudau\Common\Models\Users\Users;
use Phalcon\Mvc\User\Component;

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
            'email' => $user->getEmail()
        ]);
    }

    public function getAuth()
    {
        return $this->session->get('auth-identity');
    }

    public function getAuthSiteHome()
    {
        return $this->session->get('auth-site-home');
    }

    public function check($credentials)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        // Check if the user exist
        $user = Users::findFirst([
            'conditions' => 'username=:username: and status_id=:status_id: ',
            'bind' => [
                'username' => $credentials['username'],
                'status_id' => $status_id_enable
            ]
        ]);

        if ($user == false) {
            return 'Wrong username/password. Please try again';
        }
        if ($user->role->code != "ADMIN" && $user->role->code != "CHEF") {
            return 'User have not permission. Please try again';
        }
        // Check the password
        if (!$this->security->checkHash($credentials['password'], $user->password)) {
            return 'Wrong username/password. Please try again';
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
            'role' => $user->role->getCode(),
            'email' => $user->getEmail(),
            'image' => $user->image->getImageBase()
        ]);
        return 'true';
    }

    public function checkSiteHome($credentials)
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        // Check if the user exist
        $user = Users::findFirst([
            'conditions' => 'username=:username: and status_id=:status_id: ',
            'bind' => [
                'username' => $credentials['username'],
                'status_id' => $status_id_enable
            ]
        ]);
        if ($user == false) {
            return 'Wrong username/password. Please try again';
        }

        // Check the password
        if (!$this->security->checkHash($credentials['password'], $user->password)) {
            return 'Wrong username/password. Please try again';
        }

        // Check if the user was flagged
        $this->checkUserFlags($user);

        // Register the successful login
        $this->saveSuccessLogin($user);

        // Check if the remember me was selected
        if (isset($credentials['remember'])) {
            $this->createRememberEnvironment($user);
        }

        $this->session->set('auth-site-home', [
            'id' => $user->getId(),
            'full_name' => $user->getUsername(),
            'role' => $user->role->getCode(),
            'email' => $user->getEmail(),
            'image' => $user->image->getImageBase()
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

    public function isLoggedInSiteHome()
    {
        return is_array($this->session->get('auth-site-home'));
    }
}