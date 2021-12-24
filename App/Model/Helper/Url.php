<?php

namespace App\Model\Helper;

class Url
{
    public static function redirect(string $url)
    {
        ob_start();
        while (ob_get_status()) {
            ob_end_clean();
        }

        header("Location: $url");
    }
}