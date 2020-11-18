<?php

namespace Daudau\Modules\Admin\Controllers;

use Daudau\Common\Models\Recipe\SpamRecipe;
use Daudau\Common\Models\Users\Users;

class SpamRecipeController extends BaseDashboardController
{
    public function initialize()
    {
        parent::initialize();
    }


    public function postAjaxSpamAction()
    {
        $this->view->disable();
        $auth_site_home = $this->auth->getAuthSiteHome();
        $post = $this->request->getPost();
        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $auth_site_home['id']
            ]
        ]);
        $spam = new SpamRecipe();
        $spam->setId($spam->getSequenceId());
        $spam->setUserId($auth_site_home['id']);
        $spam->setRecipeCookId($post['recipe_cook_id']);
        $spam->setDescription($post['post_spam_content']);
        $spam->setType('spam');
        $spam->save();
        $returnvalue = [
            'value' => '
                      <div class="body" style="border-bottom: 1px solid #b2b2b28c;margin-top: 10px">'
                . '<div class="user-info" style="height: 70px">'
                . '<div class="avt" >'
                . '<a  href="/thanh-vien/mai_anh5983" target="_self" style="float: left">'
                . '<img class="" alt="mai_anh5983" src="' . $spam->user->image->getImageBase() . '" style="width: 70px; height: 70px;">'
                . '</a>'
                . '<div class="profile pull-left" style="padding-top: 22px">'
                . '<a target="_self" href="/thanh-vien/mai_anh5983" class="name cooky-user-link"><span class="ng-binding"> admin</span></a>'
                . '</div>'
                . '<div class="rating pull-right" style="margin-top: 15px">'
                . '<span class="date-time rated-date " style="font-size: 12px;color: #b2b2b2">' . date('Y-m-d G:i:s') . '</span>'
                . '<br>'
                . '<span class="date-time rated-date pull-right" >'
                . '<cooky-time style="font-size: 12px;color: #b2b2b2">' . $this->helper->util()->timepost(date('Y-m-d G:i:s')) . '</cooky-time>'
                . '</span>'
                . '</div>'
                . '</div>'
                . '</div>'
                . '<div>'
                . '<div class="content" style="min-height: auto">'
                . '<div class="" style="margin-left: 10px">' . $spam->getDescription() . '</div>'
                . '</div>'
                . '</div>'
                . '</div> '
        ];
        $spam->save();

        echo json_encode($returnvalue);
        die();
    }

}

