<?php

namespace App\Controller\Admin\Project;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Image;
use App\Model\Repository\Project as ProjectRepository;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Edit extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PRODUCT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $project = ProjectRepository::getProjectById($_GET['id']);
        if (!$project){
            throw new \Exception('Project with given ID (' . $_GET['id'] . ') does not exist');
        } else {
            $image = Image::getImageById($project->getImage());
            if (!$image) {
                $image = new \App\Model\Image();
            }
            $logo = Image::getImageById($project->getLogo());
            if (!$logo) {
                $logo = new \App\Model\Image();
            }

            View::render('admin/project-edit.phtml', compact('project', 'image', 'logo'));
        }
    }
}
