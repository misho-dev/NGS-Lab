<?php

namespace App\Helper;

class Url
{
    /**
     * TODO: test
     * @return false|string[]
     */
    public static function getPath()
    {
        $res = explode('/', strtok($_SERVER['REQUEST_URI'], '?'));
        array_shift($res);

        return $res;
    }

    public static function isAdmin()
    {
        return ucfirst(self::getPath()[0]) == 'Admin';
    }

    public static function redirect(string $url, $code = 200)
    {
        ob_start();
        while (ob_get_status()) {
            ob_end_clean();
        }

        header("Location: $url", true, $code);
    }

    public static function setResponseCode($code)
    {

    }
}