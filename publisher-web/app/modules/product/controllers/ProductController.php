<?php

namespace Publisher\Modules\Product\Controllers;

use Publisher\Common\Models\Badge\Badge;
use Publisher\Common\Models\Badge\BadgeTemplate;
use Publisher\Common\Models\Bill\Product;
use Publisher\Common\Models\Users\Users;
use Publisher\Common\Mvc\DashboardControllerBase;

class ProductController extends DashboardControllerBase
{
    private $limit_of_page = 10;

    public function initialize()
    {
        parent::initialize();
        $this->view->names = [
            [
                'label' => 'Product',
                'href' => '/product'
            ],
        ];
        $this->view->activemenu = [
            'db'
        ];

    }

    public function indexAction()
    {
        $auth = $this->session->get('auth-identity');
        $current_page = $this->request->getQuery('page', 'int', 1);
        $this->view->activemenu = [
            'bc',
            'user_list'
        ];
        $list_product = Product::find();
        $count_recipient = [];
        $total_list_product = Product::count();
        if (count($list_product) == 0) {
            $this->view->products = null;
        } else {
            $this->view->products = $list_product;
            $this->view->count_recipient = $count_recipient;
        }
        $this->view->paging = $this->helper->util()->paging($total_list_product, $this->request->getQuery(), $this->limit_of_page, $current_page);


    }

    public function createAction()
    {
        $this->view->activemenu = [
            'bc',
            'group_create'
        ];
        $this->view->names = [
            [
                'label' => 'Create Group',
                'href' => '/group/create'
            ]

        ];
        $form = new GroupForm();
        $form->creategroup();

        $group = new Group();
        $badge_template = new BadgeTemplate();
        $auth = $this->session->get('auth-identity');
        $this->db->begin();
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setEntity($post);
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $image_type = $finfo->file($_FILES['import']['tmp_name']);
            if (($image_type == "image/png" || $image_type == "image/svg+xml" || $image_type == "image/svg")) {
                if ($_FILES['import']['size'] <= 20480) {
                    move_uploaded_file($_FILES['import']['tmp_name'], BASE_PATH . "/data/upload-image/" . $_FILES['import']['name']);
                    $form->bind($post, $group);
                    $group->setId($group->getSequenceId());
                    $group->setOwnerId($auth['id']);
                    $group->setGroupEmail($auth['email']);
                    $group->setGroupUrl($group->getDefaultUrl() . '_' . $group->getId());
                    $group->setApiKey(' ');
                    $group->setStatus('GR_ACTIVE');
                    if (!$group->save()) {
                        foreach ($group->getMessages() as $message) {
                            $this->flashSession->error($this->helper->translate($message->getMessage()));
                        }
                        $form->setEntity($group);
                    } else {
                        $badge_template = new BadgeTemplate();
                        $badge_template->setId($badge_template->getSequenceId());
                        $badge_template->setGroupId($group->getId());
                        $badge_template->setStatus('ACTIVE');

                        $image_base = base64_encode(file_get_contents(BASE_PATH . "/data/upload-image/" . $_FILES['import']['name']));
                        $badge_template->setImage($image_base);
                        $badge_template->setImageType($image_type);
                        if ($badge_template->save()) {
                            $this->db->commit();
                            return $this->redirect('/group');
                        } else {
                            $this->flashSession->error($this->helper->translate('Badgetemplate'));
                            foreach ($badge_template->getMessages() as $message) {
                                $this->flashSession->error($this->helper->translate($message->getMessage()));
                            }


                            $form->setEntity($group);
                        }

                    }
                } else {
                    $this->flashSession->error("Imported file has a file size in excess of 20Kb");
                   // return $this->redirect('/group/create');
                }

            } else {
                $this->flashSession->error("The import file is not in the correct format .png and .svg");
               // return $this->redirect('/group/create');
            }

        }
        $this->view->form = $form;

    }

    public function deleteAction($id)
    {
        $this->view->disable();
        $product = Product::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($product) {
            $product->setStatusId('2');
            $product->update();

            $this->flashSession->success($this->helper->translate('Delete success'));
        } else {
            $this->flashSession->warning($this->helper->translate('Not found product'));
        }
        return $this->redirect('/product');

    }

    public function editAction($id)
    {
        $this->view->activemenu = [
            'bc',
            'group_edit'
        ];
        $this->view->names = [
            [
                'label' => 'Edit Group',
                'href' => '/group/edit'
            ]

        ];
        $form = new GroupForm();
        $form->editgroup();

        $group = Group::findFirst([
            'conditions' => 'id_=:id_:',
            'bind' => [
                'id_' => $id
            ]
        ]);
        $auth = $this->session->get('auth-identity');
        $this->db->begin();
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setEntity($post);
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            if (($_FILES['import']['size'] == 0)) {
                $form->bind($post, $group);
                $group->setOwnerId($auth['id']);
                $group->setGroupEmail($auth['email']);
                $group->setGroupUrl($group->getDefaultUrl() . '_' . $group->getId());
                if (!$group->save()) {
                    foreach ($group->getMessages() as $message) {
                        $this->flashSession->error($this->helper->translate($message));
                    }
                    $form->setEntity($group);
                } else {
                    $this->db->commit();
                    return $this->redirect('/group');
                }
            } else {
                $image_type = $finfo->file($_FILES['import']['tmp_name']);
                if (($image_type == "image/png" || $image_type == "image/svg+xml" || $image_type == "image/svg")) {
                    if ($_FILES['import']['size'] <= 20480) {
                        move_uploaded_file($_FILES['import']['tmp_name'], BASE_PATH . "/data/upload-image/" . $_FILES['import']['name']);
                        $form->bind($post, $group);
                        $group->setOwnerId($auth['id']);
                        $group->setGroupEmail($auth['email']);
                        $group->setGroupUrl($group->getDefaultUrl() . '_' . $group->getId());
                        if (!$group->save()) {
                            foreach ($group->getMessages() as $message) {
                                $this->flashSession->error($this->helper->translate($message));
                            }
                            $form->setEntity($group);
                        } else {
                            $badge_template = BadgeTemplate::findFirst([
                                'conditions' => 'group_id=:group_id:',
                                'bind' => [
                                    'group_id' => $group->getId()
                                ]
                            ]);
                            $badge_template->setGroupId($group->getId());
                            $image_base = base64_encode(file_get_contents(BASE_PATH . "/data/upload-image/" . $_FILES['import']['name']));
                            $badge_template->setImage($image_base);
                            $badge_template->setImageType($image_type);
                            if ($badge_template->save()) {
                                $this->db->commit();
                            }
                            return $this->redirect('/group');
                        }
                    } else {
                        $this->flashSession->error("File nhập lên có kích thước file vượt quá 20Kb");
                        return $this->redirect('/group/create');
                    }

                } else {
                    $this->flashSession->error("File nhập lên không đúng định dạng .png và .svg");
                    return $this->redirect('/group/create');
                }
            }
        } else {

            $form->setEntity($group);
            $badge_template = BadgeTemplate::findFirst([
                'conditions' => 'group_id=:group_id:',
                'bind' => [
                    'group_id' => $id
                ]
            ]);
            $this->view->badge_template = $badge_template;
        }
        $this->view->form = $form;

    }


}
