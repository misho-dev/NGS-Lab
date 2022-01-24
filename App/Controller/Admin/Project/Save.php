<?php

namespace App\Controller\Admin\Project;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;
use App\Model\Project as ProjectModel;
use App\Model\Repository\Project as ProjectRepository;

class Save extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PRODUCT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $project = $this->createProjectFromPostRequest();

        if (isset($_POST['create_project'])) {
            ProjectRepository::addProject($project);
        } else if (isset($_POST['update_project']) && $_GET['id']) {
            ProjectRepository::updateProject($project, $_GET['id']);
        } else {
            throw new \Exception('Unexpected error occurred. Please try again.');
        }

        UrlHelper::redirect("/admin/project");
    }

    protected function createProjectFromPostRequest()
    {
        return new ProjectModel([
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'short_description' => $_POST['short_description'],
        ]);
    }
}