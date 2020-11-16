<?php

namespace Publisher\Modules\Api\Controllers;


class IssuerController extends RestController
{
    public function initialize()
    {
        if ($this->checkApiKey() == true)
            return true;
        else {
            $this->renderLog('Can not find api key');
            die();
        }
    }

    public function allGroupsAction()
    {
        $this->getListGroup();
        die();
    }

    public function createBadgeAction()
    {

        $this->getCreateBadge();
        die();
    }

    public function recipientBadgeAction($group_id)
    {
        $this->getRecipientBadge($group_id);
        die();
    }

    public function groupAction($group_id)
    {
        $this->getGroupById($group_id);
        die();
    }


}

