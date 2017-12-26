<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/26
 * Time: 13:15
 */

//namespace openyii\framework;

class Autoload
{
    public static function loadClass($class)
    {

        $file = $class . '.php';
        $file = str_replace("openyii",$_SERVER['DOCUMENT_ROOT'] ."\..",$file);

        if (is_file($file)) {
            require_once($file);
        }
    }
}