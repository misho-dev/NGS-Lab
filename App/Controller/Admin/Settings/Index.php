<?php

namespace App\Controller\Admin\Settings;

use App\Controller\ControllerAction;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Index implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        View::render('admin/settings.phtml');
    }
}
