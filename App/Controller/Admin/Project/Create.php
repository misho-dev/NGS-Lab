<?php


namespace App\Controller\Admin\Project;


use App\Controller\Admin\AbstractAdminAction;
use App\Model\Project;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Create extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PRODUCT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $project = new Project();
        View::render('admin/project-edit.phtml', compact('project'));
    }
}