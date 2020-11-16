<?php

namespace Daudau\Modules\Admin\Controllers;

use Daudau\Common\Models\Recipe\Image;
use Daudau\Common\Models\Users\Role;
use Daudau\Common\Models\Users\Status;
use Daudau\Common\Models\Users\Users;
use Daudau\Modules\Admin\Forms\LoginForm;
use Daudau\Modules\Admin\Forms\SignUpForm;

class LoginController extends BaseLoginController
{
    public function initialize()
    {
        parent::initialize();
        $this->view->stylesheetsother = [
            "/public/css/recipe.create.min.css",
        ];
    }

    public function indexAction()
    {

    }

    public function loginAction()
    {
        $form = new LoginForm();
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            try {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flashSession->error($message);
                    }
                } else {

                    $check = $this->auth->check([
                        'username' => trim($this->request->getPost('username')),
                        'password' => trim($this->request->getPost('password')),
                        'remember' => trim($this->request->getPost('remember'))
                    ]);
                    if ($check == 'true') {
                        return $this->response->redirect('/admin');
                    } else {
                        $this->flashSession->error($this->helper->translate($check));
                        $form->setEntity($post);
                    }
                }

            } catch (AuthException $e) {
                $this->flashSession->error($e->getMessage());
            }
        } else {
            if ($this->auth->isLoggedIn()) {

                return $this->redirect('/admin');

            }
        }
        $form->clear();
        $this->view->form = $form;
    }

    public function logoutAction()
    {
        $this->session->remove('language');
        $this->session->remove('auth-identity');
        return $this->response->redirect('/admin/dang-nhap');
    }

    public function resetPasswordAction()
    {
        $code = $this->dispatcher->getParam('code');
        $resetPassword = OpResetPasswords::findFirstByCode($code);
        if (!$resetPassword) {
            return $this->response->redirect("/");
        }
        if ($resetPassword->confirm != 0) {
            return $this->response->redirect("/admin/dang-nhap");
        }
        $resetPassword->confirm = 'Y';
        /**
         * Change the confirmation to 'reset'
         */
        if (!$resetPassword->save()) {
            foreach ($resetPassword->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return $this->response->redirect("/");
        }
        /**
         * Identify the user in the application
         */
        $this->auth->authUserById($resetPassword->user_id);
        $this->flashSession->success('Please reset your password');
        return $this->response->redirect("/profile/changePassword");
    }

    public function forgotPasswordAction()
    {
        $form = new ForgotPasswordForm();
        if ($this->request->isPost()) {
            // Send emails only is config value is set to true
            if ($this->getDI()->get('config')->useMail) {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $user = OpUsers::findFirstByEmail($this->request->getPost('email'));

                    if (!$user) {
                        $this->flashSession->success('There is no account associated to this email');
                    } else {
                        $resetPassword = new OpResetPasswords();
                        $resetPassword->user_id = $user->id;

                        if ($resetPassword->save()) {
                            $this->flashSession->success('Success! Please check your email for a reset password message');
                        } else {

                            foreach ($resetPassword->getMessages() as $message) {
                                $this->flashSession->error($message);
                            }
                        }
                    }
                }
            } else {
                $this->flashSession->warning('Emails are currently disabled. Change config key "useMail" to true to enable emails.');
            }
        }
        $this->view->form = $form;
    }

    public function changeLanguageAction()
    {
        // $this->view->disable();
        $language = $this->request->getQuery('language');
        if (!$this->session->get('language')) {
            $this->session->set('language', 'en');
        } else {
            $this->session->set('language', $language);
        }
        //  return $this->redirect($_SERVER["HTTP_REFERER"]);
    }

    public function signUpAction()
    {
        $status_id_enable = Status::getStatusIdByCode('enable');
        $form = new SignUpForm();
        $role_user_id = Role::getIdByCode('ADMIN');

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            try {

                $user = new Users();
                if ($post['re_password'] != $post['password']) {
                    $this->flashSession->error($this->helper->translate("Mật khẩu và "));
                    $form->setEntity($post);
                } else {
                    $form->bind($post, $user);
                    $user->setId($user->getSequenceId());
                    $user->setStatusId($status_id_enable);
                    $error_check_validitions = Users::checkValidations($post);
                    if (count($error_check_validitions) != 0) {
                        foreach ($error_check_validitions as $message) {
                            $this->flashSession->error($this->helper->translate($message));
                        }
                        $form->setEntity($post);
                    } else {
                        $token = openssl_random_pseudo_bytes(16);
                        $token = bin2hex($token);
                        $user->setToken($token);
                        $user->setRoleId($role_user_id);
                        $image = new Image();
                        $image->setId($image->getSequenceId());
                        $image->setCode($image->setCode('AVATAR-USER-' . $user->getId()));
                        $image->setImageBase('data:image/png;base64,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');
                        $image->setImageUrl("/public/account.png");
                        $image->setStatusId($status_id_enable);
                        // $image->setImageUrlResize("/public/image-upload-resize/" . $_FILES['imageUpload']['name']);
                        $user->setImageId($image->getId());
                        $user->save();
                        $image->save();
                        if ($user->save()) {
                            $this->flashSession->success($this->helper->translate('Đăng ký thành công'));
                            return $this->redirect('/admin/dang-nhap');
                        } else {
                            foreach ($user->getMessages() as $message) {
                                $this->flashSession->error($this->helper->translate($message->getMessage()));
                            }
                            $form->setEntity($post);

                        }
                    }
                }

            } catch (AuthException $e) {
                $this->flashSession->error($e->getMessage());
            }
        }
        $this->view->form = $form;
    }

}

