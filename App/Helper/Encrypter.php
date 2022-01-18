<?php

namespace App\Helper;

class Encrypter
{
    /**
     * @param string $password
     * @param string $salt
     * @return string
     */
    public static function encrypt(string $password, string $salt = ''): string
    {
        return md5($password . $salt);
    }
}
