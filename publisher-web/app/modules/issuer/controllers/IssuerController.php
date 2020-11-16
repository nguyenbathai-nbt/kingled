<?php

namespace Publisher\Modules\Issuer\Controllers;

use Phalcon\Tag;
use Publisher\Common\Models\Users\Users;
use Publisher\Common\Mvc\DashboardControllerBase;
use Publisher\Modules\Issuer\Forms\IssuedForm;


class IssuerController extends DashboardControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->view->names = [
            [
                'label' => 'Issuer',
                'href' => '/issuer'
            ],
        ];
    }

    public function indexAction()
    {
        $this->view->activemenu = [
            'is',
            'issuer_list'
        ];
        $this->view->issued = null;
        $auth = $this->session->get('auth-identity');
        $current_page = $this->request->getQuery('page', 'int', 1);
        $limit_of_page = 10;
        $list_issuer = Users::find([
            'limit' => $this->limit_of_page,
            'offset' => (($current_page - 1) * $limit_of_page),
            'order' => 'id_ ASC'
        ]);

        $total_list_issuer = Users::count([

        ]);
        if (count($list_issuer) == 0) {
            $this->view->list_issuer = null;
        } else {
            $this->view->list_issuer = $list_issuer;
        }
        $this->view->paging = $this->helper->util()->paging($total_list_issuer, $this->request->getQuery(), $limit_of_page, $current_page);

    }

    public function createAction()
    {
        $this->view->activemenu = [
            'is',
            'issuer_create'
        ];
        $issuer = new Users();
        $form = new IssuedForm();
        $form->createissuer();
        Tag::setDefault('username', null);
        Tag::setDefault('password', null);
        Tag::setDefault('email', null);
        $this->view->form = $form;
        if ($this->request->isPost()) {
            $post = $this->request->getPost();

            $form->bind($post, $issuer);
            $token = openssl_random_pseudo_bytes(16);
            $token = bin2hex($token);
            $issuer->setUserKey($token);
            $issuer->save();
        }

    }

    public function apiKeyAction()
    {
        $this->view->names = [
            [
                'label' => 'Api Key',
                'href' => '/issuer/apiKey'
            ],
        ];
        $this->view->activemenu = [
            'ak'

        ];

        $auth = $this->session->get('auth-identity');
        $this->view->apikey = $auth['user_key'];
    }

    public function webSubscriberAction()
    {
        $this->view->names = [
            [
                'label' => 'Api Key',
                'href' => '/issuer/webSubscriber'
            ],
        ];
        $this->view->activemenu = [
            'ws'

        ];
        $auth = $this->session->get('auth-identity');
        $issuer = Users::findFirst([
            'conditions' => 'user_key=:user_key:',
            'bind' => [
                'user_key' => $auth['user_key']
            ]
        ]);
        $websubscriber = "";
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $issuer->setSubscriberUrl($post['websubscriber']);
            if ($issuer->save()) {
                $this->flashSession->success($this->helper->translate('Save success'));
                $websubscriber = $post['websubscriber'];
            } else {
                foreach ($issuer->getMessages() as $message) {
                    $this->flashSession->error($this->helper->translate($message->getMessage()));
                }
            }
        } else {
            $websubscriber = $issuer->getSubscriberUrl();
        }
        $this->view->websubscriber = $websubscriber;
    }

    public function changePasswordAction($id)
    {
        $this->view->disable();
        $form = new IssuedForm();
        $form->changepassword();

        $this->view->form = $form;
        $this->view->user_id = $id;
        $this->view->setPartialsDir("");
        echo $this->view->partial('issuer/changePassword');
    }

    public function loadAjaxChangePasswordAction()
    {
        $post = $this->request->getPost();
        if ($this->request->isPost()) {
            if ($post['new_password'] != $post['confirm_password']) {
                $respone =
                    [
                        'typeresult' => 'warning',
                        'messageresult' => 'Password and Confirm password not match'
                    ];
                echo json_encode($respone);
            } else {
                if (Users::changePassword($post['id'], $post['new_password'])) {
                    $respone = [
                        'typeresult' => 'success',
                        'messageresult' => 'Password has changed'
                    ];
                } else {
                    $respone = [
                        'typeresult' => 'error',
                        'messageresult' => 'Password can not change'
                    ];
                }
                echo json_encode($respone);
            }
            die();
        }
    }

    public function viewIssuerAction($id)
    {
        $this->view->activemenu = [
            'is',
            'issuer_list'
        ];
        $form = new IssuedForm();
        $form->viewissuer();
        $issuer = Users::findFirst([
            'conditions' => 'id_=:id_:',
            'bind' => [
                'id_' => $id
            ]
        ]);
        $form->setEntity($issuer);
        $this->view->form = $form;
    }

}

