<?php
/**
 * Created by PhpStorm.
 * User: djavolak
 * Date: 10.9.16.
 * Time: 16.11
 */

namespace Publisher\Modules\Api\Controllers;

use Phalcon\Mvc\Controller;
use Publisher\Common\Models\Badge\Badge;
use Publisher\Common\Models\Badge\BadgeInfo;
use Publisher\Common\Models\Group\Group;
use Publisher\Common\Models\Users\Product;

/**
 * Class RestController.
 * Base class for all controllers for REST API.
 *
 * @package Api\Controller
 */
class RestController extends Controller
{

    /**
     * Render data from payload
     *
     * @return \Phalcon\Http\ResponseInterface
     * @throws \Api\Exception\NotImplementedException
     *
     */
    protected function getListGroup()
    {
        $header = apache_request_headers();
        $user = Product::findFirst([
            'conditions' => 'user_key=:user_key:',
            'bind' => [
                'user_key' => $header['apikey']
            ]
        ]);
        $format = $this->request->getQuery('format', null, 'json');
        $list_group = Group::find([
            'conditions' => 'owner_id=:owner_id:',
            'bind' => [
                'owner_id' => $user->getId()
            ],
            'order' => 'group_code ASC'
        ]);
        $list_group = [
            "groups" => $list_group
        ];
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list_group);
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

    protected function checkApiKey()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $header = apache_request_headers();
        if (isset($header['apikey'])) {
            $user = Product::findFirst([
                'conditions' => 'user_key=:user_key:',
                'bind' => [
                    'user_key' => $header['apikey']
                ]
            ]);
            if ($user) {
                return true;
            } else {
                return false;
            }
        }
    }

    protected function renderLog($content)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $log[] = $content;
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($log);
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

    protected function getRecipientBadge($group_id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        // $group_id = file_get_contents('php://input');
        $list_badge = Badge::find([
            'conditions' => 'group_id=:group_id:',
            'bind' => [
                'group_id' => $group_id
            ]
        ]);
        $list = [];
        foreach ($list_badge as $lst_badge) {
            $recipient_by_badge_id = BadgeInfo::findFirst([
                'conditions' => 'id_=:id_:',
                'bind' => [
                    'id_' => $lst_badge->getId()
                ]
            ]);
            if ($recipient_by_badge_id) {
                $list[] = [
                    'id' => $recipient_by_badge_id->getId(),
                    'email' => $recipient_by_badge_id->getRecipientId(),
                    'name' => $recipient_by_badge_id->getRecipientName(),
                    'assertion_id' => $recipient_by_badge_id->getAssertionId(),
                    'issued_date' => $recipient_by_badge_id->getIssuedDate(),
                ];
            }
        }
        $list = [
            'recipients' => $list
        ];

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

    protected function getGroupById($id)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list_group = Group::findFirst([
            'conditions' => 'id_=:id_:',
            'bind' => [
                'id_' => $id
            ]
        ]);
        $list_group = [
            "group" => $list_group
        ];
        switch ($format) {
            case 'json':
                $contentType = 'application/json';
                $encoding = 'UTF-8';
                $content = json_encode($list_group);
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
