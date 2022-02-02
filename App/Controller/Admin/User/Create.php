<?php

namespace App\Controller\Admin\User;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Project;
use App\Model\User;
use App\ViewModel\View;

class Create extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_USER;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $user = new User();
        $projects = Project::getProjects();
        View::render('admin/user-edit.phtml', compact('user', 'projects'));
    }
}