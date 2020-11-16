<?php

namespace Subscriber\Modules\Api\Controllers;


class IssuerController extends RestController
{


    public function allGroupsAction()
    {
        $this->getListGroup();
        die();
    }

    public function recipientBadgeAction()
    {
        $group_url = $this->request->getQuery('group_url');
        $this->getRecipientBadge($group_url);
        die();
    }

}

