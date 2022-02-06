<?php

namespace App\Controller\Admin\Project;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\ImageUploader;
use App\Helper\Url;
use App\Model\Repository\Project as ProjectRepository;

class Upload extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PROJECT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $project = ProjectRepository::getProjectById($_GET['id']);
        if (!$project) {
            throw new \Exception('Project with given ID (' . $_GET['id'] . ') does not exist');
        }

        $this->uploadImage();
        $this->uploadLogo();

        Url::redirect('/admin/project/edit?id=' . $_GET['id']);
    }

    /**
     * @throws \Exception
     */
    protected function uploadImage()
    {
        $imageId = ImageUploader::uploadAndSaveImage(
            $_POST['project_pic_id'],
            'project_pic',
            $_POST['project_pic_title'],
            $_POST['project_pic_alt']
        );

        if ($imageId) {
            ProjectRepository::updateImage($imageId, $_GET['id']);
        }
    }

    /**
     * @throws \Exception
     */
    protected function uploadLogo()
    {
        $imageId = ImageUploader::uploadAndSaveImage(
            $_POST['project_logo_id'],
            'project_logo',
            $_POST['project_logo_title'],
            $_POST['project_logo_alt']
        );

        if ($imageId) {
            ProjectRepository::updateLogo($imageId, $_GET['id']);
        }
    }
}
