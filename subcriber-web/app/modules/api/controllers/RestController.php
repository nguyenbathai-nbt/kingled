<?php
/**
 * Created by PhpStorm.
 * User: djavolak
 * Date: 10.9.16.
 * Time: 16.11
 */

namespace Subscriber\Modules\Api\Controllers;

use Phalcon\Mvc\Controller;
use Subscriber\Common\Models\Badge\BadgeInfo;
use Subscriber\Common\Models\Users\Users;

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


    protected function checkApiKey()
    {
        $format = $this->request->getQuery('format', null, 'json');
        $header = apache_request_headers();
        if (isset($header['apikey'])) {
            $user = Users::findFirst([
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

    protected function getRecipientBadge($group_url)
    {
        $format = $this->request->getQuery('format', null, 'json');
        $list = [];
        $group_url = urldecode($group_url);
        $recipient_by_group_url = BadgeInfo::find([
            'conditions' => 'group_url=:group_url:',
            'bind' => [
                'group_url' => $group_url
            ],
            'order' => 'recipient_name ASC'

        ]);
        foreach ($recipient_by_group_url as $item) {
            $list[] = [
                'id' => $item->getId(),
                'email' => $item->getRecipientId(),
                'name' => $item->getRecipientName(),
                'url' => 'http://' . $_SERVER['HTTP_HOST'] . '/badge/info/' . $item->getAssertionId(),
                'issued_date' => $item->getIssuedDate(),
                'assertion_id' => $item->getAssertionId()
            ];
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
}
