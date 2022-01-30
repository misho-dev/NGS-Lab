<?php

namespace App\Controller\Admin\User;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Image;
use App\Model\Repository\Project;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Edit extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_USER;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $user = UserRepository::getUserById($_GET['id']);
        if (!$user){
            throw new \Exception('User with given ID (' . $_GET['id'] . ') does not exist');
        } else {
            $image = Image::getImageById($user->getImage());
            if (!$image) {
                $image = new \App\Model\Image();
            }
            $gif = Image::getImageById($user->getGif());
            if (!$gif) {
                $gif = new \App\Model\Image();
            }

            $projects = Project::getProjects();
            $ownedProjects = UserRepository::getProjects($user->getId());
            View::render('admin/user-edit.phtml', compact('user', 'image', 'gif', 'projects', 'ownedProjects'));
        }
    }
}
