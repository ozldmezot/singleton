<?php namespace Ozldmezot\Singleton;

abstract class Singleton
{
    public static $instance;

    public function __construct($alias, $instance)
    {

        self::$instance  = $instance;
        class_alias(__CLASS__, $alias);
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([self::$instance, $name], $arguments);
    }
}
