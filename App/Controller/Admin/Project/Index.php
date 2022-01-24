<?php

namespace App\Controller\Admin\Project;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Project as ProjectRepository;
use App\ViewModel\View;

class Index extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PRODUCT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $projects = ProjectRepository::getProjects();
        View::render('admin/project-list.phtml', compact('projects'));
    }
}
