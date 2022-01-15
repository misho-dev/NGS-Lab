<?php

namespace App\Config;

use App\Model\Database\DAL;

class Config
{
    const TABLE_NAME = 'config_data';

    /**
     * @throws \Exception
     */
    public static function get($path)
    {
        $value = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select('value')
            ->where('path', $path)
            ->get();

        if (!count($value)) {
            return null;
        }

        return $value[0]['value'];
    }

    /**
     * @param $path
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public static function set($path, $value)
    {
        $curValue = self::get($path);

        if ($curValue === null) {
            return DAL::builder()
                ->table(self::TABLE_NAME)
                ->insert(['path' => $path, 'value' => $value])
                ->execute();
        } else {
            return DAL::builder()
                ->table(self::TABLE_NAME)
                ->update(['value' => $value])
                ->where('path', $path)
                ->execute();
        }
    }
}