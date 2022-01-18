<?php

namespace App\Controller\Admin;

use App\Controller\ControllerAction;

abstract class AbstractAdminAction implements ControllerAction
{
    /** @var string Can be used by admin controllers to specify permission level. PERMISSION_NONE by default */
    const ACTION_PERMISSION = self::PERMISSION_NONE;

    // Rest is set of permissions

    /** @var string No permission */
    const PERMISSION_NONE = 'none';

    /** @var string Highest level. Grants access to every action */
    const PERMISSION_ADMIN = 'admin';

    const PERMISSION_USER = 'user';
    const PERMISSION_BLOG = 'blog';
    const PERMISSION_PRODUCT = 'product';
    const PERMISSION_PROJECT = 'project';
}
