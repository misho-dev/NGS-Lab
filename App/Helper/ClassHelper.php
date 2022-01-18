<?php

namespace App\Helper;

use App\Controller\ControllerAction;

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
     * @return string
     */
    public static function getClassPathFromDir(string $dir, string $className)
    {
        $formattedDir = str_replace('/', '\\', rtrim($dir,"/"));
        $formattedClassName = self::formatClassName($className);
        return $formattedDir . '\\' . $formattedClassName;
    }

    /**
     * @param string $dir
     * @param string $className
     * @return mixed|null
     */
    public static function createClassFromDir(string $dir, string $className)
    {
        $class = self::getClassPathFromDir($dir, $className);
        if (class_exists($class)) {
            return new $class();
        } else {
            return null;
        }
    }

    public static function isController($dir, $action)
    {
        try {
            $classReflection = new \ReflectionClass(self::getClassPathFromDir($dir, $action));

            return isset($classReflection->getInterfaces()['App\Controller\ControllerAction']);
        } catch (\ReflectionException $e) {
            return null;
        }
    }

    public static function isAdminController($dir, $action)
    {
        try {
            $classReflection = new \ReflectionClass(self::getClassPathFromDir($dir, $action));

            return $classReflection->getParentClass()->getName() == 'App\Controller\Admin\AbstractAdminAction';
        } catch (\ReflectionException $e) {
            return null;
        }
    }
}
