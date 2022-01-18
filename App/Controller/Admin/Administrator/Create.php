<?php

namespace App\Controller\Admin\Administrator;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Administrator;
use App\ViewModel\View;

class Create extends AbstractAdminAction
{
    public function execute()
    {
        $administrator = new Administrator([]);
        View::render('admin/administrator-edit.phtml', compact('administrator'));
    }
}