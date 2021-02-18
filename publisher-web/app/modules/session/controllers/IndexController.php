<?php

namespace Publisher\Modules\Session\Controllers;

use Publisher\Common\Models\Users\Product;
use Publisher\Common\Models\Users\Users;
use Publisher\Modules\Session\Forms\LoginForm;
use Publisher\Modules\Session\Forms\SignUpForm;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setMainView(MAIN_VIEW_PATH . '/dashboard');
        $this->view->setLayoutsDir(MAIN_VIEW_PATH . '/layouts/');
        $this->view->setLayout('dashboard_login');
        $this->view->setPartialsDir(MAIN_VIEW_PATH . '/partials/');
        $this->tag->setTitle('Badgechain | Login');
        $this->view->stylesheets = [
            "/AdminLTE-2.4.10/plugins/iCheck/square/blue.css"
        ];
        $this->view->cssClass = "login-page";
        $this->view->scripts = [
            '/public/js/jquery.js',
            '/public/bootstrap/js/bootstrap.min.js',
            "/AdminLTE-2.4.10/dist/js/adminlte.min.js",
            '/public/js/js.js',
            "/AdminLTE-2.4.10/bower_components/fastclick/lib/fastclick.js",
            "/AdminLTE-2.4.10/dist/js/adminlte.min.js",
            "/AdminLTE-2.4.10/plugins/iCheck/icheck.min.js",
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
            if ($this->auth->isLoggedIn() == true) {
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
        return $this->response->redirect('/');
    }

    public function resetPasswordAction()
    {
        $code = $this->dispatcher->getParam('code');
        $resetPassword = OpResetPasswords::findFirstByCode($code);
        if (!$resetPassword) {
            return $this->response->redirect("/");
        }
        if ($resetPassword->confirm != 0) {
            return $this->response->redirect("/login");
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
            $this->session->set('language', 'vi');
        } else {
            $this->session->set('language', $language);
        }
        //  return $this->redirect($_SERVER["HTTP_REFERER"]);
    }

    public function signUpAction()
    {
        $form = new SignUpForm();
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            try {

                $user = new Users();
                if ($post['re_password'] != $post['password']) {
                    $this->flashSession->error($this->helper->translate("Password and Repasswrod don't match"));
                    $form->setEntity($post);
                } else {
                    $form->bind($post, $user);
                    $user->setId($user->getSequenceId());
                    $user->setRoleId('1');
                    $user->setStatusId('1');
                    $error_check_validitions = Users::checkValidations($post);
                    if (count($error_check_validitions) != 0) {
                        foreach ($error_check_validitions as $message) {
                            $this->flashSession->error($this->helper->translate($message));
                        }
                        $form->setEntity($post);
                    } else {
                        if ($user->save()) {
                            $this->flashSession->success($this->helper->translate('Sign up success'));
                            return $this->redirect('/login');
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

