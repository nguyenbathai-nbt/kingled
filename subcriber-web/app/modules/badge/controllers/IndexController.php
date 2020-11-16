<?php

namespace Subscriber\Modules\Badge\Controllers;

use Endroid\QrCode\QrCode;
use GuzzleHttp\Client;
use Subscriber\Common\Models\Badge\Badge;
use Subscriber\Common\Models\Badge\BadgeInfo;
use Subscriber\Common\Mvc\DashboardControllerBase;

class IndexController extends DashboardControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->view->names = [
            [
                'label' => 'Dashboard',
                'href' => '/admin'
            ],
        ];
        $this->view->activemenu = [
            'db'

        ];
    }

    public function indexAction()
    {
        $auth = $this->session->get('auth-identity');
        if (count($auth) == 0) {
            $this->session->set('previous-url', $this->request->getURI());
            $this->flashSession->warning($this->helper->translate('Please login'));
            return $this->redirect('/login');
        } else {

        }
        $auth = $this->session->get('auth-identity');
        $list_badge = BadgeInfo::find([
            'conditions' => 'recipient_id=:recipient_id:',
            'bind' => [
                'recipient_id' => $auth['email']
            ]
        ]);
        $count_issuer = BadgeInfo::count([
            'conditions' => 'recipient_id=:recipient_id:',
            'bind' => [
                'recipient_id' => $auth['email']
            ],
            'distinct' => 'a_b_issued_id'
        ]);
        $auth = $this->session->get('auth-identity');

        $this->view->recipient_name = $auth['full_name'];
        $this->view->total_badge = count($list_badge);
        $this->view->total_issuer = $count_issuer;
        $this->view->list_badge = $list_badge;
    }

    public function infoAction($id)
    {
        $code = $_SERVER['HTTP_HOST'] . $this->request->getURI();
        $qrCode = new QrCode($code);
        $this->view->qrCodeUri = $qrCode->writeDataUri();
        $badge_info = BadgeInfo::findFirst([
            'conditions' => 'assertion_id=:assertion_id:',
            'bind' => [
                'assertion_id' => $id
            ]
        ]);
        if ($badge_info == null) {
            $this->view->badge_info = $badge_info;
        } else {
            $badge = Badge::findFirst([
                'conditions' => 'id_=:id_:',
                'bind' => [
                    'id_' => $badge_info->getId()
                ]
            ]);
            $this->view->bchain_trans_id = $badge->getBchainTransId();
            $this->view->bchain_data = $badge->getBchainData();
            $request_data = base64_decode($badge->getRequestData());
            $this->view->request_data = $request_data;
            $group_url = $badge_info->getGroupUrl();
            $parts = explode('_', $group_url);
            $last = array_pop($parts);
            $parts = array(implode('_', $parts), $last);
            $this->view->group_url = $parts[0];
            $this->view->badge = $badge;
            $this->view->badge_info = $badge_info;
            $auth = $this->auth->isLoggedIn();
            if ($auth) {
                $this->view->auth = 'true';
            } else {
                $this->view->auth = 'false';
            }

        }


    }

    public function verifyAction()
    {
        $this->view->disable();
        $post = $this->request->getPost();
        $client = new Client();
        $params = array('hashValue' => $post['id'], 'Content-Type' => 'application/json');
        try {
            $di = $this->getDI();
            $config = $di->getConfig();
            $response = $client->get($config->subcriberConfig->defaultDomain . ':8080/web/ws/badge/verify', array(
                'headers' => $params

            ));
            $result = json_decode($response->getBody());
            if ($result->code == 0) {
                $demo =
                    [
                        'value' => 'Verification successful',
                        'color' => 'green',
                        'urlimage' => '/public/verifysuccess.png'
                    ];
            } else {
                $demo =
                    [
                        'value' => 'Verification unsuccessful',
                        'color' => 'red',
                        'urlimage' => '/public/verifyfail.png'
                    ];
            }
        } catch (\Exception $e) {
            $demo =
                [
                    'value' => 'Verification unsuccessful',
                    'color' => 'red',
                    'urlimage' => '/public/verifyfail.png'
                ];
        }


        echo json_encode($demo);
        die();
    }

    public function developAction()
    {

    }
}

