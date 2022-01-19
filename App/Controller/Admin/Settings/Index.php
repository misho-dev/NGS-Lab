<?php

namespace App\Controller\Admin\Settings;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Index extends AbstractAdminAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        View::render('admin/settings.phtml');
    }
}
