<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AbstractAdminAction;

class Index extends AbstractAdminAction
{
    public function execute()
    {
        $dashboardIndex = new \App\Controller\Admin\Dashboard\Index();
        $dashboardIndex->execute();
    }
}
