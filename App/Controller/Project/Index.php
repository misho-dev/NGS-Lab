<?php

namespace App\Controller\Project;

use App\Controller\ControllerAction;
use App\Model\Repository\Image;
use App\Model\Repository\Project as ProjectRepository;
use App\ViewModel\View;

class Index implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $project = ProjectRepository::getProjectById($_GET['id']);
        if (!$project) {
            View::render('contact.html'); // TODO: 404 page
        } else {
            $image = Image::getImageById($project->getImage()) ?? new \App\Model\Image();
            $logo = Image::getImageById($project->getLogo())  ?? new \App\Model\Image();

            View::render('project-page.phtml', compact('project', 'image', 'logo'));
        }
    }
}
