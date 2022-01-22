<?php

namespace App\Controller\Admin\Blog;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Blog;
use App\ViewModel\View;

class Create extends AbstractAdminAction
{
    public const ACTION_PERMISSION = self::PERMISSION_BLOG;

    public function execute()
    {
        $blog = new Blog();
        View::render('admin/blog-edit.phtml', compact('blog'));
    }
}