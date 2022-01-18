<?php

namespace App\Controller\Admin\Blog;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Blog as BlogRepository;
use App\ViewModel\View;

class Index extends AbstractAdminAction
{
    public const ACTION_PERMISSION = self::PERMISSION_BLOG;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $blogs = BlogRepository::getBlogs();
        View::render('admin/blog-list.phtml', compact('blogs'));
    }
}
