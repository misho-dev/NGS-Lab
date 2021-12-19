<?php

namespace App\Model\Helper;

class ClassHelper
{
    /**
     * @param string $class
     * @return string
     */
    public static function formatClassName(string $class): string
    {
        return ucfirst(strtolower($class));
    }

    /**
     * @param string $dir
     * @param string $className
     * @return mixed|null
     */
    public static function createFromDir(string $dir, string $className)
    {
        $formattedDir = str_replace('/', '\\', rtrim($dir,"/"));
        $formattedClassName = self::formatClassName($className);
        $class = $formattedDir . '\\' . $formattedClassName;
        if (class_exists($class)){
            return new $class();
        } else {
            return null;
        }
    }
}