<?php

namespace Daudau\Modules\Api\Controllers;


use Daudau\Modules\Api\Rest\RestAccountController;

class AccountController extends RestAccountController
{

    public function informationUserAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $user_id_other = $this->request->getQuery('user_id_ọther');
        $this->getInformationUser($user_id, $user_id_other);
        die();
    }

    public function changePasswordAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $old_password = $this->request->getQuery('old_password');
        $new_password = $this->request->getQuery('new_password');
        $this->getChangePassword($user_id, $old_password, $new_password);
        die();

    }

    public function listBookmarkUserAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $this->getListBookmarkUser($user_id);
        die();
    }

    public function bookmarkUserAction()
    {
        $user_id = $this->request->getQuery('user_id');
        $user_bookmark_id = $this->request->getQuery('user_followed_id');
        $this->getBookmarkUser($user_id, $user_bookmark_id);
        die();
    }

    public function RateUserAction()
    {
        $point = $this->request->getQuery('point');
        $user_id = $this->request->getQuery('user_id');
        $user_bookmark_id = $this->request->getQuery('user_followed_id');
        $this->getRateUser($point,$user_id, $user_bookmark_id);
        die();
    }
}

