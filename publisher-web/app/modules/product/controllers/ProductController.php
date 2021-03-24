<?php

namespace Publisher\Modules\Product\Controllers;

use Publisher\Common\Models\Badge\BadgeTemplate;
use Publisher\Common\Models\Bill\Product;
use Publisher\Common\Mvc\DashboardControllerBase;
use Publisher\Modules\Product\Forms\ProductForm;

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
            'product',
            'product_list'
        ];
        $this->view->names = [
            [
                'label' => 'Danh sách sản phẩm',
                'href' => '/product'
            ]

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
            'product',
            'product_create'
        ];
        $this->view->names = [
            [
                'label' => 'Thêm mới sản phẩm',
                'href' => '/product/create'
            ]

        ];
        $form = new ProductForm();
        $product = new Product();
        $form->createproduct();

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $this->db->begin();
            $form->bind($post, $product);
            if ($product->save()) {
                $this->db->commit();
                $this->flashSession->success($this->helper->translate('Thêm mới sản phẩm thành công'));
                return $this->redirect('/product');
            } else {
                foreach ($product->getMessages() as $message) {
                    $this->flashSession->error($this->helper->translate($message->getMessage()));
                }
                $form->setEntity($post);
            }
        }
        $this->view->form = $form;

    }

    public function importProductAction()
    {
        $this->view->activemenu = [
            'product',
            'product_create_excel'
        ];
        $this->view->names = [
            [
                'label' => 'Thêm mới sản phẩm',
                'href' => '/product/importproduct'
            ]

        ];
        $form = new ProductForm();

        $form->importproduct();

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $file = $_FILES['import']['tmp_name'];
            $data_import = $this->helper->import($file, 'IMPORT_TRANSCRIPT', $post)->getData();
            $this->db->begin();
            $error = 0;
            foreach ($data_import as $item) {
                $product = new Product();
                $product->setName($item['name']);
                $product->setCode($item['code']);
                $product->setDescription($item['description']);
                if ($product->save()) {

                } else {
                    foreach ($product->getMessages() as $message) {
                        $this->flashSession->error($item['code']);
                        $this->flashSession->error($this->helper->translate($message['_message']));
                    }
                    $error = 1;
                    break;
                }
            }
            if ($error == 0) {
                $this->db->commit();
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

