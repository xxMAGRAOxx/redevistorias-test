<?php
/**
 * Created by Carlos Magno
 * User: Carlos Magno
 * Contact: cmagnosoares@gmail.com
 * Github: https://github.com/xxMAGRAOxx
 *

 **/
/*
 * Autoload
 */

$classes = [
    'ClientSide\Server\Config\SysConfig',
    'ClientSide\Server\Connect',
    'ClientSide\Server\Exception',
    'ClientSide\Server\Request',
    'ClientSide\Movies'
];

/**
 * Used to load the class passed by parameter.
 * @param $className
 */
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}

foreach($classes as $class)
{
    autoload($class);
}