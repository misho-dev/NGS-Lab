<?php

namespace App\Controller\Admin\Blog;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;
use App\Model\Repository\Blog as BlogRepository;

class Delete extends AbstractAdminAction
{
    public const ACTION_PERMISSION = self::PERMISSION_BLOG;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        BlogRepository::deleteBlog($_GET['id']);
        UrlHelper::redirect("/admin/blog");
    }
}
