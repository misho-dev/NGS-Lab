<?php

namespace App\Controller\Admin\Blog;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\ImageUploader;
use App\Helper\Url;
use App\Model\Repository\Blog as BlogRepository;

class Upload extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_BLOG;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $blog = BlogRepository::getBlogById($_GET['id']);
        if (!$blog) {
            throw new \Exception('Blog with given ID (' . $_GET['id'] . ') does not exist');
        }

        $this->uploadImage();

        Url::redirect('/admin/blog/edit?id=' . $_GET['id']);
    }

    /**
     * @throws \Exception
     */
    protected function uploadImage()
    {
        $imageId = ImageUploader::uploadAndSaveImage(
            $_POST['blog_pic_id'],
            'blog_pic',
            $_POST['blog_pic_title'],
            $_POST['blog_pic_alt']
        );

        if ($imageId) {
            BlogRepository::updateImage($imageId, $_GET['id']);
        }
    }
}
