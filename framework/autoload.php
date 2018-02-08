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
        $file = str_replace("openyii",__DIR__ ."\..",$file);
        $file = str_replace("\\","/",$file);           //linux系统不支持 ‘\’

        if (is_file($file)) {
            require_once($file);
        }
    }
}