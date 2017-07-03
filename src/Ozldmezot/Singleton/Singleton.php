<?php namespace Ozldmezot\Singleton;

abstract class Singleton
{
    protected static $class;
    protected static $instance;
    protected static $arguments;
    public function __construct($alias, $class, $arguments)
    {

        self::$class     = $class;
        self::$instance  = null;
        self::$arguments = $arguments;
        class_alias(__CLASS__, $alias);
    }

    public static function __callStatic($name, $arguments)
    {
        if (!self::$instance) {
            $reflector = new \ReflectionClass(self::$class);
            self::$instance = $reflector->newInstanceArgs(self::$arguments);

        }
        call_user_func_array([self::$instance, $name], $arguments);
    }

}