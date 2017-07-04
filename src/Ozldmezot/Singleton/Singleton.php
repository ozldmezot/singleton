<?php namespace Ozldmezot\Singleton;

abstract class Singleton
{
    protected static $classes;
    protected static $attributes;
    protected static $instances;

    public function __construct($alias, $class, $attributes = [])
    {
        $called_class = get_called_class();
        class_alias($called_class, $alias);
        static::$classes[$called_class]    = $class;
        static::$attributes[$called_class] = $attributes;
    }

    public static function __callStatic($name, $arguments)
    {
        $called_class = get_called_class();
        if (!isset(static::$instances[$called_class])) {
            $reflector = new \ReflectionClass(static::$classes[$called_class]);
            self::$instances[$called_class] = $reflector->newInstanceArgs(static::$attributes[$called_class]);


        }
        $instance = static::$instances[$called_class];
        return call_user_func_array([$instance, $name], $arguments);
    }

    public static function instance()
    {
        $called_class = get_called_class();
        if (!isset(static::$instances[$called_class])) {
            $reflector = new \ReflectionClass(static::$classes[$called_class]);
            self::$instances[$called_class] = $reflector->newInstanceArgs(static::$attributes[$called_class]);


        }
        $instance = static::$instances[$called_class];
        return static::$instances[get_called_class()];
    }
}
