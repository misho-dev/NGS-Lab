<?php

namespace App\Helper;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Administrator;

class AdminSession
{
    /**
     * @return bool
     */
    public static function isLoggedIn()
    {
        return isset($_SESSION['admin']) && self::getAdmin() != null;
    }

    /**
     * @return Administrator
     */
    public static function getAdmin()
    {
        if (isset ($_SESSION['admin']['model'])) {
            return $_SESSION['admin']['model'];
        }

        return null;
    }

    /**
     * @param Administrator $admin
     */
    public static function setAdmin(Administrator $admin)
    {
        $_SESSION['admin']['model'] = $admin;
    }

    /**
     * @param $e
     */
    public static function addErrorLog($e)
    {
        $_SESSION['admin']['error_log'][] = $e;
    }

    public static function getErrorLog()
    {
        if (!isset($_SESSION['admin']) || !isset($_SESSION['admin']['error_log'])) {
            $_SESSION['admin']['error_log'] = [];
        }

        return $_SESSION['admin']['error_log'];
    }

    public static function clearErrorLog()
    {
        unset($_SESSION['admin']['error_log']);
    }

    /**
     * @param $permission
     * @return bool
     */
    public static function hasPermission($permission)
    {
        if ($permission == AbstractAdminAction::PERMISSION_NONE) {
            return true;
        }

        if (self::isLoggedIn()) {
            return in_array($permission, self::getAdmin()->getPermissionsAsArray());
        }

        return false;
    }

    /**
     * Clear admin session
     */
    public static function reset()
    {
        $_SESSION['admin'] = [];
        $_SESSION['admin']['error_log'] = [];
    }
}
