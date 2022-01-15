<?php

namespace App\Model\Helper;

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

    public static function redirect(string $url)
    {
        ob_start();
        while (ob_get_status()) {
            ob_end_clean();
        }

        header("Location: $url");
    }
}