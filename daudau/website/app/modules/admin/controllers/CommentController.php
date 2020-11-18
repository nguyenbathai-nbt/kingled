<?php

namespace Daudau\Modules\Admin\Controllers;

use Daudau\Common\Models\Recipe\Comment;
use Daudau\Common\Models\Users\Role;
use Daudau\Common\Models\Users\Users;
use Daudau\Modules\Admin\Forms\CommentForm;
use Daudau\Modules\Admin\Forms\RoleForm;
use Phalcon\Tag;

class CommentController extends BaseDashboardController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function listCommentAction()
    {
        $this->view->activemenu = [
            'comment',
            'comment_list'
        ];
        $this->view->names = [
            [
                'label' => 'List Comment',
                'href' => '/admin/comment/listComment'
            ],
        ];
        $current_page = $this->request->getQuery('page', 'int', 1);
        $limit_of_page = 10;
        $form = new CommentForm();
        $form->search();
        $this->view->form = $form;
        $cond_array = [];
        $param_url = $this->request->getQuery();
        $bind_data = [];
        foreach ($param_url as $key => $value) {
            Tag::setDefault($key, $value);
            if ($key != '_url' && $key != 'page' && $value != '') {
                if ($key == 'active' && $value != '') {
                    $value = trim($value);
                    array_push($cond_array, "$key =:$key:");
                    $bind_data[$key] = $value;
                } else if ($key == 'active' && $value == '') {
                    array_push($cond_array, "active='1'");
                } else {
                    $value = trim($value);
                    array_push($cond_array, "$key =:$key:");
                    $bind_data[$key] = $value;
                }
            }
        }

        $conditions = implode(' AND ', $cond_array);
        $comment = Comment::find([
            'conditions' => $conditions,
            'bind' => $bind_data,
            'limit' => $limit_of_page,
            'offset' => (($current_page - 1) * $limit_of_page),
        ]);
        $comment_total_record = Comment::count([
            'conditions' => $conditions,
            'bind' => $bind_data
        ]);
        if (count($comment) == 0) {
            $this->view->comment = null;
        } else {
            $this->view->comment = $comment;
        }
        $this->view->paging = $this->helper->util()->paging($comment_total_record, $this->request->getQuery(), $limit_of_page, $current_page);

    }

    public function createCommentAction()
    {
        $this->view->activemenu = [
        ];
        $this->view->names = [
            [
                'label' => 'Tạo bình luận',
                'href' => '/admin/comment/createComment'
            ],
        ];
        $comment = new Comment();
        $form = new CommentForm();
        $form->create();
        $this->view->form = $form;
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $comment->setId($comment->getSequenceId());
            $form->bind($post, $comment);
            $error = Role::checkValidations($post);
            if (count($error) != 0) {
                foreach ($error as $er) {
                    $this->flashSession->error($this->helper->translate($er));
                }
            } else {
                if ($comment->save()) {
                    $this->flashSession->success($this->helper->translate('Tạo bình luận thành công'));
                    return $this->redirect('/admin/comment/listComment');
                } else {
                    foreach ($comment->getMessages() as $message) {
                        $this->flashSession->error($this->helper->translate($message->getMessage()));
                    }
                    $form->setEntity($post);
                }
            }
        }
    }

    public function deleteCommentAcion($id)
    {
        $this->view->disable();
        $role = Role::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($role) {
            $role->delete();
        } else {
            $this->flashSession->warning($this->helper->translate('Không tìm thấy bình luận'));
        }
    }

    public function editCommentAction($id)
    {
        $this->view->activemenu = [
            'user',
            'role_list'
        ];
        $this->view->names = [
            [
                'label' => 'Danh sách bình luận',
                'href' => '/admin/role/listRole'
            ],
        ];
        $form = new RoleForm();
        $form->edit();

        $role = Role::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $role);
            if ($role->save()) {
                $this->flashSession->success($this->helper->translate('Chỉnh sửa bình luận thành công'));
                return $this->redirect('/admin/role/listRole');
            } else {
                foreach ($role->getMessages() as $message) {
                    $this->flashSession->error($this->helper->tranlate($message->getMessage()));
                }
            }
        } else {
            $form->setEntity($role);
        }

        $this->view->form = $form;
    }

    public function viewCommentAction($id)
    {
        $this->view->activemenu = [
            'user',
            'role_list'
        ];
        $this->view->names = [
            [
                'label' => 'Xem thông tin bình luận',
                'href' => '/admin/role/listRole'
            ],
        ];
        $form = new RoleForm();
        $form->view();

        $role = Role::findFirst([
            'conditions' => 'id=:id:',
            'bind' => [
                'id' => $id
            ]
        ]);
        $form->setEntity($role);
        $this->view->form = $form;
    }

    public function postAjaxCommentAction()
    {
        $this->view->disable();
        $auth_site_home = $this->auth->getAuthSiteHome();
        $post = $this->request->getPost();
        $user= Users::findFirst([
            'conditions'=>'id=:id:',
            'bind'=>[
                'id'=>$auth_site_home['id']
            ]
        ]);
        $comment = new Comment();
        if (isset($post['type'])) {
            $comment->setId($comment->getSequenceId());
            $comment->setUserId($auth_site_home['id']);
            $comment->setRecipeCookId($post['recipe']);
            $comment->setComment($post['comment']);
            $comment->setParentPath($post['parent']);
            $returnvalue = [
                'value' => '  
                      <div class="comments-wrapper ng-scope">'
                         . '<div class="comments parent-comments clearfix ng-scope" style="margin-bottom:5px;" id="comment-6658">'
                            . '<div class="cooky-comment-item-new">'
                                . '<div class="comment-item">'
                                    . '<div class="comment-profile-img">'
                                        . '<a class="user-avt" href="/thanh-vien/nhuoctran07823" target="_self"><img  alt="'.$user->getUserName().'" src="'.$user->image->getImageBase().'"></a>'
                                    . '</div>'
                                    . '<div class="comment-content">'
                                        . '<div class="comment-head" style="width:100%">'
                                            . '<a style="color:#333; float:left" class="cooky-user-link ng-binding" data-userid="189657" title="" href="/thanh-vien/nhuoctran07823">'.$auth_site_home['full_name'].'</a>'
                                            . '<div style="margin-left: 10px; float:left; font-size: 11px;line-height:18px;" class="date-time" title="17/07/2019 11:39:54">'
                                                . '<cooky-time created-on="1563338394" created-on-text="17/07/2019 11:39:54">'.$this->helper->util()->timepost( date('Y-m-d G:i:s')).'</cooky-time>'
                                            . '</div>'
                                        . '</div>'
                                        . '<div class="comment-text to-trusted-html-with-emoticon clearfix ng-isolate-scope" style="word-wrap: inherit;background: #eee;padding: 10px;float: left;border-radius: 10px;margin-top: -10px;">'.$comment->getComment().'</div>'
                                        . '<div class="clearfix"></div>'
                                    . '</div>'
                                . '</div>'
                            . '</div>'
                         . '</div>'
                    . '</div>'
            ];
            $comment->save();
        } else {
            $comment->setId($comment->getSequenceId());
            $comment->setUserId($auth_site_home['id']);
            $comment->setRecipeCookId($post['recipe']);
            $comment->setComment($post['comment-content']);
            $comment->setParentPath('null');
            $returnvalue = [
                'value' => '
                <div class="review-item recipe-review-item ng-scope" ng-repeat="review in mainReviews">'
                    . '<div class="body">'
                        . '<div class="user-info">'
                            . '<div class="avt">'
                                . '<a ng-href="/thanh-vien/mai_anh5983" href="/thanh-vien/mai_anh5983" target="_self">'
                                . '<img class=""  alt="' . $auth_site_home['full_name'] . '" src="'.$user->image->getImageBase().'">'
                                . '</a>'
                            . '</div>'
                            . '<div class="profile">'
                                . '<a target="_self" href="/thanh-vien/mai_anh5983" class="name cooky-user-link" data-userid="322458" data-hasqtip="0" oldtitle="mai_anh5983" aria-describedby="qtip-0">'
                                . '<span class="ng-binding">' . $auth_site_home['full_name'] . '</span>'
                                . '</a>'
                            . '</div>'
                        . '</div>'
                        . '<div>'
                            . '<div class="content" style="min-height: auto">'
                                 . '<div class="review-content to-trusted-html-with-emoticon ng-isolate-scope" text-content="review.Content">' . $comment->getComment().'</div>'
                            . '</div>'
                        . '</div>'
                        . '<div class="photos-container"></div>'
                        . '<div class="rating">'
                            . '<span class="date-time rated-date ng-hide" ng-show="false" title="'.date('Y-m-d G:i:s').'">'.date('Y-m-d G:i:s').'</span>'
                            . '<span class="date-time rated-date" ng-show="true">'
                                . '<a ng-href="/cong-thuc/tran-chau-duong-den-27528/danh-gia/137448" href="/cong-thuc/tran-chau-duong-den-27528/danh-gia/137448" target="_self">'
                                    . '<cooky-time created-on="1564205118" created-on-text="27/07/2019 12:25:18" title="27/07/2019 12:25:18">'.$this->helper->util()->timepost(date('Y-m-d G:i:s')).'</cooky-time>'
                                . '</a>'
                            . '</span>'
                        . '</div>'
                    . '</div>'
                    . '<div class="cooky-like-comment-widget-new ng-isolate-scope">'
                        .'<div id="list_respone_comment">'
                        .'</div>'
                         . '<div class="comments-wrapper ng-scope">'
                              . '<div class="review-comment-container">'
                                 . '<div class="comment-profile-img">'
                                   . '<a href="javascript:void(0);">'
                                      . '<img class="img-responsive img-rounded"  alt="Bá Thái Nguyễn" ng-src="https://media.cooky.vn/usr/g35/343551/avt/c70x70/cooky-avatar-637019279923804920.jpg" src="https://media.cooky.vn/usr/g35/343551/avt/c70x70/cooky-avatar-637019279923804920.jpg">'
                                   . '</a>'
                                 . '</div>'
                                 . '<div class="comment-content input-box">'
                                     . '<textarea style="border-radius: 10px; padding-right: 50px; min-height: 50px; border: none; overflow-y: hidden; height: 50px;" id name="'.$comment->getId().'"  class="respone-comment-post form-comment-control auto-height ng-untouched ng-valid ng-empty ng-dirty ng-valid-parse" contenteditable="true"  placeholder="thảo luận của bạn"></textarea>'
                                     . '<div class="clearfix text-small text-gray"  style="padding:4px 10px;">#TIP: Bấm enter để gửi, bấm shift + enter để xuống dòng</div>'
                                     . '</div>'
                                     . '<div class="full">'
                                        . '<span ng-show="isPostingComment" style="float: left;margin-left: 40px;"  class="ng-hide"><img  src="/Content/ajax-loader.gif"></span>'
                                        . '<div class="text-highlight text-small ng-hide"  style="padding:4px 0;text-align:right;"  ng-show="model.commentText.length == 0 &amp;&amp; imagesQueue.length>0">* Chưa nhập nội dung thảo luận</div>'
                                        . '<div class="text-right ng-hide" ng-show="model.commentText.length>0"  style="padding:5px 8px 0 0">'
                                            . '<button class="btn btn-link text-gray btn-sm" ng-click="cancelComment()">Huỷ</button>'
                                            . '<button class="btn btn-primary btn-sm" ng-click="sendComment()"  ng-disabled="isPostingComment || model.commentText == null || model.commentText.length==0" disabled="disabled">Hoàn tất</button>'
                                        . '</div>'
                                 . '</div>'
                              . '</div>'
                         . '</div>'
                    . '</div>'
                . '</div>'
            ];
            $comment->save();
        }
        echo json_encode($returnvalue);
        die();
    }

}

