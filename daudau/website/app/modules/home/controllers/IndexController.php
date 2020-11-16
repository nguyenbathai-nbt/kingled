<?php

namespace Daudau\Modules\Home\Controllers;

use Daudau\Common\Models\Bookmark\Bookmark;
use Daudau\Common\Models\Bookmark\BookmarkUser;
use Daudau\Common\Models\Recipe\RecipeCook;
use Daudau\Common\Models\Recipe\SeenRecipe;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Models\Users\Users;
use Daudau\Common\Mvc\Controller;

class IndexController extends Controller
{
    public function initialize()
    {
        parent::initialize();

    }

    public function indexAction()
    {
        $auth_site_home = $this->auth->getAuthSiteHome();
        $status_id_enable = Status::getStatusIdByCode('enable');
        $list_recipe = RecipeCook::find([
            'conditions' => 'status_id=:status_id:',
            'bind' => [
                'status_id' => $status_id_enable
            ],
            'order' => 'created_time DESC'
        ]);
        $list_bookmark_reipe = Bookmark::find([
            'conditions' => 'user_id=:user_id: and status_id=:status_id: and bookmark_type=:bookmark_type:',
            'bind' => [
                'user_id' => $auth_site_home['id'],
                'status_id' => $status_id_enable,
                'bookmark_type' => 'favourite'
            ]
        ]);
        $list_bookmark = [];
        foreach ($list_recipe as $index => $item) {
            $list_bookmark[$item->getId()] = 'false';
            foreach ($list_bookmark_reipe as $index2 => $item2) {
                if ($item->getId() == $item2->getRecipeCookId()) {
                    $list_bookmark[$item->getId()] = 'true';
                    break;
                }
            }
        }
        $list_user = Users::find([]);
        $list = [];
        foreach ($list_user as $item) {
            $count = BookmarkUser::count([
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $item->getId(),
                    'type' => 'bookmark_user'
                ]
            ]);
            $list[$item->getId()] = $count;
        }
        arsort($list);
        foreach ($list as $index => $item) {
            $list_top_user[] = Users::findFirst([
                'conditions' => 'id=:id:',
                'bind' => [
                    'id' => $index
                ]
            ]);
        }
        $list_recipe_bookmark_user = $this->getRecipeByBookmarkUser();
        $list_seen_popular = $this->getRecipePopularAction();

        if ($auth_site_home) {
            $list_book_recipe_popular = [];
            foreach ($list_seen_popular as $item) {
                $value = Bookmark::findFirst([
                    'conditions' => 'user_id=:user_id: and status_id=:status_id: and bookmark_type=:bookmark_type: and recipe_cook_id=:recipe_cook_id:',
                    'bind' => [
                        'user_id' => $auth_site_home['id'],
                        'status_id' => $status_id_enable,
                        'bookmark_type' => 'favourite',
                        'recipe_cook_id'=>$item->recipe->getId()
                    ]
                ]);
                if($value)
                {
                    $list_book_recipe_popular[$item->recipe->getId()] = 'true';
                }else{
                    $list_book_recipe_popular[$item->recipe->getId()] = 'false';
                }

            }
            $list_book_recipe_bookmark_user = [];
            foreach ($list_recipe_bookmark_user as $item) {
                $value = Bookmark::findFirst([
                    'conditions' => 'user_id=:user_id: and status_id=:status_id: and bookmark_type=:bookmark_type: and recipe_cook_id=:recipe_cook_id:',
                    'bind' => [
                        'user_id' => $auth_site_home['id'],
                        'status_id' => $status_id_enable,
                        'bookmark_type' => 'favourite',
                        'recipe_cook_id'=>$item->getId()
                    ]
                ]);
                if($value)
                {
                    $list_book_recipe_bookmark_user[$item->getId()] = 'true';
                }else{
                    $list_book_recipe_bookmark_user[$item->getId()] = 'false';
                }

            }
        } else {
            $list_book_recipe_popular = [];
            foreach ($list_seen_popular as $item) {
                $list_book_recipe_popular[$item->recipe->getId()] = 'false';
            }
            $list_book_recipe_bookmark_user = [];
            foreach ($list_seen_popular as $item) {
                $list_book_recipe_bookmark_user[$item->getId()] = 'false';
            }
        }
        $this->view->list_seen_popular = $list_seen_popular;
        $this->view->list_book_recipe_popular = $list_book_recipe_popular;
        $this->view->list_book_recipe_bookmark_user = $list_book_recipe_bookmark_user;
        $this->view->list_recipe_bookmark_usser = $list_recipe_bookmark_user;
        $this->view->list_top_user = $list_top_user;
        $this->view->list_bookmark = $list_bookmark;
        $this->view->list_recipe = $list_recipe;
        $this->view->auth_site_home = $auth_site_home;
        if ($auth_site_home == null) {
            $this->view->user_id = '""';
        } else {
            $this->view->user_id = $auth_site_home['id'];
        }
    }

    public function contactAction()
    {

    }

    public function getRecipeByBookmarkUser()
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $list_user = BookmarkUser::find([
            'conditions' => 'user_id=:user_id: and status_id=:status_id: and type=:type:',
            'bind' => [
                'user_id' => $auth_site_home['id'],
                'status_id' => $status_id_enable,
                'type' => 'bookmark_user'
            ]
        ]);
        $list_user_id = [];
        foreach ($list_user as $item) {
            $list_user_id[] = $item->getBookmarkUserId();

        }
        if (count($list_user_id) != 0) {
            $rs = RecipeCook::query()
                ->columns("Daudau\Common\Models\Recipe\RecipeCook.*")
                ->where("Daudau\Common\Models\Recipe\RecipeCook.user_id IN (" . implode(',', $list_user_id) . ")")
                ->andWhere("Daudau\Common\Models\Recipe\RecipeCook.status_id=4");
            $sid = $rs->execute();
            return $sid;
        } else {
            return null;
        }
    }

    public function getRecipePopularAction()
    {
        $date_now = date('Y-m-d G:i:s');
        $auth_site_home = $this->auth->getAuthSiteHome();
        $status_id_enable = Status::getStatusIdByCode('enable');
        $format = $this->request->getQuery('format', null, 'json');
        $seen_recipe = SeenRecipe::find([
            'order' => "created_time DESC"
        ]);
        $list_seen_popular = [];
        foreach ($seen_recipe as $item) {
            //if ((strtotime($date_now) - strtotime($item->getCreatedTime()) < 2692000)) {

            if ($item->recipe->getStatusId() == $status_id_enable) {
                // $list_seen_popular[$item->getRecipeCookId()] = $item;
                $demo = date('Y-m-d H:i:s', (strtotime($date_now) - 2692000));
                $list_seen_popular[$item->getRecipeCookId()] = SeenRecipe::count([
                    'conditions' => 'created_time> :created_time: and recipe_cook_id=:recipe_cook_id:',
                    'bind' => [
                        'created_time' => date('Y-m-d H:i:s', (strtotime($date_now) - 2692000)),
                        'recipe_cook_id' => $item->getRecipeCookId()
                    ]
                ]);
            }
        }
        arsort($list_seen_popular);
        foreach ($list_seen_popular as $index => $item) {
            $list_seen_popular[$index] = SeenRecipe::findFirst([
                'conditions' => 'recipe_cook_id=:recipe_cook_id:',
                'bind' => [
                    'recipe_cook_id' => $index
                ]
            ]);
        }
        return $list_seen_popular;
    }

}

