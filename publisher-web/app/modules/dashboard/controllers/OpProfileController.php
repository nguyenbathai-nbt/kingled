<?php


namespace CoursemosCloud\Modules\Dashboard\Controllers;



use CoursemosCloud\Common\Models\Opteam\OpPasswordChanges;
use CoursemosCloud\Modules\Dashboard\Forms\ChangePasswordForm;
use CoursemosCloud\Common\Mvc\DashboardControllerBase;

class OpProfileController extends DashboardControllerBase
{
    public function index()
    {
        $this->view->names = [
            "Profile"
        ];
    }
    public function changePasswordAction()
    {
        $this->view->names = [
            [
                'label' => 'Profile',
                'href' => '/profile'
            ],
            [
                'label' => 'Change password',
                'href' => '/profile/changePassword'
            ]
        ];
        $form = new ChangePasswordForm();
        if ($this->request->isPost()) {

            if (!$form->isValid($this->request->getPost())) {

                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $user = $this->auth->getUser();

                $user->password = $this->security->hash($this->request->getPost('password'));

                $passwordChange = new OpPasswordChanges();
                $passwordChange->user = $user;
                $passwordChange->ip_address = $this->request->getClientAddress();
                $passwordChange->user_agent = $this->request->getUserAgent();

                if (!$passwordChange->save()) {
                    foreach($passwordChange->getMessages() as $msg) {
                        $this->flashSession->error($msg);
                    }

                } else {
                    $this->flashSession->success('Your password was successfully changed');
                }
            }
        }
        $form->clear();
        $this->view->form = $form;
    }
}