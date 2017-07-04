<?php namespace Ozldmezot\Singleton;

abstract class Singleton
{
    protected static $instances;

    public function __construct($alias, $instance)
    {
        $class = get_called_class();
        class_alias($class, $alias);
        static::$instances[$class] = $instance;
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = static::$instances[get_called_class()];
        return call_user_func_array([$instance, $name], $arguments);
    }

    public static function instance()
    {
        return static::$instances[get_called_class()];
    }
}
