<?php

namespace App\Helper;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Administrator;

class Session
{
    public static function setLanguage($language)
    {
        $_SESSION['language'] = $language;
    }

    public static function getLanguage()
    {
        return $_SESSION['language'] ?: 'en' ;
    }
}
