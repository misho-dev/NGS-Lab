<?php

namespace App\Controller\Project;

use App\Controller\ControllerAction;
use App\Model\Repository\Image;
use App\Model\Repository\Project as ProjectRepository;
use App\ViewModel\View;

class Listing implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $projects = ProjectRepository::getProjects();

        $projectImages = [];
        $projectLogos = [];
        foreach ($projects as $project) {
            $projectImages[$project->getId()] = Image::getImageById($project->getImage()) ?? new \App\Model\Image();
            $projectLogos[$project->getId()] = Image::getImageById($project->getLogo()) ?? new \App\Model\Image();
        }

        View::render('project-listing.phtml', compact('projects', 'projectImages', 'projectLogos'));
    }
}
