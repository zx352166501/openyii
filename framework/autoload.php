<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/25
 * Time: 11:56
 */

// todo autoload

class Loader
{
    public static function loadClass($class)
    {

        $file = $class . '.php';
        $file = str_replace("frame",$_SERVER['DOCUMENT_ROOT'] ."\..",$file);
        if (is_file($file)) {
            require_once($file);
        }
    }
}
