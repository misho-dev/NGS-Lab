<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Dashboard\Index as DashboardIndex;
use App\Controller\ControllerAction;

class Index implements ControllerAction
{
    /**
     * Redirect to admin dashboard
     */
    public function execute()
    {
        $dashboardIndex = new DashboardIndex();
        $dashboardIndex->execute();
    }
}