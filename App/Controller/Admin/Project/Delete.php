<?php

namespace App\Controller\Admin\Project;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url;
use App\Model\Repository\Project;

class Delete extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PROJECT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        Project::deleteProject($_GET['id']);
        Url::redirect("/admin/project");
    }
}
