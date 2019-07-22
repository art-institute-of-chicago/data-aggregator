<?php

namespace App\Models;

trait Instancable
{

    /**
     * Return the cached instance or create a new instance of this model.
     * Uses an array to accomodate for multiple inherited models calling
     * this same method.
     *
     * @return static
     */
    public static function instance()
    {
        static $instances = [];

        $calledClass = get_called_class();

        if (!isset($instances[$calledClass])) {
            $instances[$calledClass] = new $calledClass();
        }

        return $instances[$calledClass];
    }

}
