<?php

namespace App\Controller\Admin;

use App\Controller\ControllerAction;

interface AdminAction extends ControllerAction
{
    /**
     * Get permission required to perform the action
     */
    public function getPermission();
}
