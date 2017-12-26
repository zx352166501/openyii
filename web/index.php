<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/25
 * Time: 10:08
 */

//require $_SERVER['DOCUMENT_ROOT'] . "/../framework/CController.php";
//require $_SERVER['DOCUMENT_ROOT'] . "/../framework/CModel.php";
//require $_SERVER['DOCUMENT_ROOT'] . "/../framework/CWebApplication.php";
//require $_SERVER['DOCUMENT_ROOT'] . "/../framework/autoload.php";

$config = $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";

require $_SERVER['DOCUMENT_ROOT'] . "/../config/web.php";


$app = \frame\framework\CWebApplication::createApplication($config);

spl_autoload_register(array('Loader', 'loadClass'));


$app ->run();

