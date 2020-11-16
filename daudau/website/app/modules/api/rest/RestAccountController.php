<?php

namespace Daudau\Modules\Api\Rest;

use Daudau\Common\Models\Bookmark\BookmarkUser;
use Daudau\Common\Models\Recipe\RecipeCook;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Models\Users\Users;
use Phalcon\Mvc\Controller;

class RestAccountController extends Controller
{
    protected function getInformationUser($user_id, $user_id_other)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_enable = Status::getStatusIdByCode('enable');

        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $user_id
            ]
        ]);
        $user_other = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $user_id_other
            ]
        ]);
        $bookmark_user = BookmarkUser::findFirst([
            'conditions' => 'user_id=:user_id: and bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
            'bind' => [
                'user_id' => $user_id,
                'bookmark_user_id' => $user_id_other,
                'status_id' => $status_id_enable,
                'type' => 'bookmark_user'
            ]
        ]);
        $total_bookmark = BookmarkUser::count([
            'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
            'bind' => [
                'bookmark_user_id' => $user_id_other,
                'status_id' => $status_id_enable,
                'type' => 'bookmark_user'
            ]
        ]);
        $count_like_by_recipe = RecipeCook::find([
            'conditions' => 'user_id=:user_id: and status_id=:status_id:',
            'bind' => [
                'user_id' => $user_id_other,
                'status_id' => $status_id_enable
            ]
        ]);
        $count = 0;
        foreach ($count_like_by_recipe as $item2) {
            $count += $item2->getBookmarkTotal();
        }

        $recipe_count = RecipeCook::count([
            'conditions' => 'user_id=:user_id: and status_id=:status_id:',
            'bind' => [
                'user_id' => $user_id_other,
                'status_id' => $status_id_enable
            ]
        ]);
        $average_rate = BookmarkUser::average([
            'column' => 'point',
            'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
            'bind' => [
                'bookmark_user_id' =>$user_id_other,
                'status_id' => $status_id_enable,
                'type' => 'rate'
            ]
        ]);
        if ($average_rate == null) {
            $average_rate = 0;
        }
        $list = [];
        $list['name'] = $user_other->getUserName();
        $list['avatar'] = $user_other->image->getImageUrl();
        $list['likes'] = $count;
        $list['recipe_counter'] = $recipe_count;
        $list['follower'] = $total_bookmark;
        $list['rate'] = $average_rate;
        if ($bookmark_user) {
            $list['followed'] = 'true';
        } else {
            $list['followed'] = 'false';
        }
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }

        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }


    protected function getChangePassword($user_id, $old_password, $new_password)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_enable = Status::getStatusIdByCode('enable');

        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $user_id
            ]
        ]);
        $list = [];
        if ($user == false) {
            $list = [
                'code' => 2,
                'message_error' => 'Wrong username/password. Please try again'
            ];
        } else if (!$this->security->checkHash($old_password, $user->getPassword())) {
            $list = [
                'code' => 2,
                'message_error' => 'Wrong username/password. Please try again'
            ];
        } else {
            $user->setPassword($this->getDI()
                ->getSecurity()
                ->hash($new_password));
            $user->save();
            $list = [
                'code' => 1,
                'message' => 'Đổi mật khẩu thành công!'
            ];
        }

        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }
        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();


    }

    protected function getListBookmarkUser($user_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_enable = Status::getStatusIdByCode('enable');

        $user = Users::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $user_id
            ]
        ]);
        $bookmark_user = BookmarkUser::find([
            'conditions' => 'user_id=:user_id: and status_id=:status_id: and type=:type: ',
            'bind' => [
                'user_id' => $user_id,
                'status_id' => $status_id_enable,
                'type' => 'bookmark_user'

            ]
        ]);
        $list = [];
        foreach ($bookmark_user as $index => $item) {
            $count_like_by_recipe = RecipeCook::find([
                'conditions' => 'user_id=:user_id: and status_id=:status_id:',
                'bind' => [
                    'user_id' => $item->bookmark_user->getId(),
                    'status_id' => $status_id_enable
                ]
            ]);
            $count = 0;
            foreach ($count_like_by_recipe as $item2) {
                $count += $item2->getBookmarkTotal();
            }
            $total_bookmark = BookmarkUser::count([
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $item->bookmark_user->getId(),
                    'status_id' => $status_id_enable,
                    'type' => 'bookmark_user'
                ]
            ]);
            $average_rate = BookmarkUser::average([
                'column' => 'point',
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $user->getId(),
                    'status_id' => $status_id_enable,
                    'type' => 'rate'
                ]
            ]);
            if ($average_rate == null) {
                $average_rate = 0;
            }
            $list[$index]['id'] = $item->bookmark_user->getId();
            $list[$index]['name'] = $item->bookmark_user->getUserName();
            $list[$index]['avatar'] = $item->bookmark_user->image->getImageUrl();
            $list[$index]['likes'] = $count;
            $list[$index]['follower'] = $total_bookmark;
            $list[$index]['followed'] = 'true';
            $list[$index]['rate'] = $average_rate;

        }


        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }

        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getBookmarkUser($user_id, $user_bookmark_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_disable = Status::getStatusIdByCode('disable');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $bookmark_user = BookmarkUser::findFirst([
            'conditions' => 'user_id=:user_id: and bookmark_user_id=:bookmark_user_id: and type=:type: ',
            'bind' => [
                'user_id' => $user_id,
                'bookmark_user_id' => $user_bookmark_id,
                'type' => 'bookmark_user'
            ]
        ]);
        $list = [];
        if ($bookmark_user) {
            if ($bookmark_user->getStatusId() == $status_id_disable) {
                $bookmark_user->setStatusId($status_id_enable);
                $bookmark_user->save();
                $total = BookmarkUser::count([
                    'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                    'bind' => [
                        'bookmark_user_id' => $user_bookmark_id,
                        'status_id' => $status_id_enable,
                        'type' => 'bookmark_user'

                    ]
                ]);
                $list =
                    [
                        'code' => 1,
                        'message' => 'followed',
                        'total' => $total,
                    ];
            } else {
                $bookmark_user->setStatusId($status_id_disable);
                $bookmark_user->save();
                $total = BookmarkUser::count([
                    'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                    'bind' => [
                        'bookmark_user_id' => $user_bookmark_id,
                        'status_id' => $status_id_enable,
                        'type' => 'bookmark_user'
                    ]
                ]);
                $list =
                    [
                        'code' => 2,
                        'message' => 'quit follow',
                        'total' => $total,
                    ];
            }
        } else {
            $bookmark_user = new BookmarkUser();
            $bookmark_user->setId($bookmark_user->getSequenceId());
            $bookmark_user->setUserId($user_id);
            $bookmark_user->setBookmarkUserId($user_bookmark_id);
            $bookmark_user->setStatusId($status_id_enable);
            $bookmark_user->setType('bookmark_user');
            $bookmark_user->save();
            $total = BookmarkUser::count([
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $user_bookmark_id,
                    'status_id' => $status_id_enable,
                    'type' => 'bookmark_user'
                ]
            ]);
            $list =
                [
                    'code' => 1,
                    'message' => 'followed',
                    'total' => $total,
                ];
        }
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }

        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }

    protected function getRateUser($point, $user_id, $user_bookmark_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $status_id_enable = Status::getStatusIdByCode('enable');
        $bookmark_user = BookmarkUser::findFirst([
            'conditions' => 'user_id=:user_id: and bookmark_user_id=:bookmark_user_id: and type=:type:',
            'bind' => [
                'user_id' => $user_id,
                'bookmark_user_id' => $user_bookmark_id,
                'type' => 'rate'
            ]
        ]);
        if ($bookmark_user) {
            $bookmark_user->setPoint($point);
            $bookmark_user->save();
            $total = BookmarkUser::average([
                'column' => 'point',
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $user_bookmark_id,
                    'status_id' => $status_id_enable,
                    'type' => 'rate'
                ]
            ]);
            $list =
                [
                    'value' => $total,
                ];

        } else {
            $bookmark_user = new BookmarkUser();
            $bookmark_user->setId($bookmark_user->getSequenceId());
            $bookmark_user->setUserId($user_id);
            $bookmark_user->setBookmarkUserId($user_bookmark_id);
            $bookmark_user->setStatusId($status_id_enable);
            $bookmark_user->setType('rate');
            $bookmark_user->setPoint($point);
            $bookmark_user->save();
            $total = BookmarkUser::average([
                'column' => 'point',
                'conditions' => 'bookmark_user_id=:bookmark_user_id: and status_id=:status_id: and type=:type:',
                'bind' => [
                    'bookmark_user_id' => $user_bookmark_id,
                    'status_id' => $status_id_enable,
                    'type' => 'rate'
                ]
            ]);
            $list =
                [
                    'value' => $total
                ];
        }
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list);
                break;
            default:
                throw new \Api\Exception\NotImplementedException(
                    sprintf('Requested format %s is not supported yet.', $format)
                );
                break;
        }

        $this->response->setContentType($contentType, $encoding);
        $this->response->setContent($content);
        return $this->response->send();
    }


}

