<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 11:20
 */
//
////phpinfo();
//$config = require(__DIR__ . '/config/main.php');
//
//$defaultController = "index";
//$defaultAction = "index";
//
//if(!empty($_GET['r'])){
//
//    $route = $_GET['r'];
//    $pos = strpos($route,'/');   // 查找字符串在另一字符串中第一次出现的位置
//
//    $defaultController = substr($route,0,$pos);
//    $defaultController = strtolower($defaultController); //  把所有字符转换为小写
//    $defaultAction = (string) substr($route,$pos+1);
//
//    $className = ucfirst($defaultController)."Controller";      // 函数把字符串中的首字符转换为大写
//    $classFile = $_SERVER['DOCUMENT_ROOT']."/modules/controllers/".$className.".php";
//
//    if(is_file($classFile)){
//
//        if(!class_exists($className,false)){
//
//            require $classFile;
//            $class = new $className;
//            $functionName = "action".ucfirst($defaultAction);
//
//            $class ->$functionName();
//        }
//
//    }else{
//
//        // todo 默认目录
//        echo  "dir error";
//
//    }
//
//}else{
//
//    // todo 默认目录
//    echo  "route error";
//
//}


require $_SERVER['DOCUMENT_ROOT'] . "/framework/CController.php";
require $_SERVER['DOCUMENT_ROOT'] . "/framework/CWebApplication.php";

$config = $_SERVER['DOCUMENT_ROOT'] . "/config/main.php";
$app = CWebApplication::createApplication($config);

$app ->run();

