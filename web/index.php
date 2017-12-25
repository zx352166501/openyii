<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/25
 * Time: 10:08
 */

require $_SERVER['DOCUMENT_ROOT'] . "/../framework/CController.php";
require $_SERVER['DOCUMENT_ROOT'] . "/../framework/CWebApplication.php";

require $_SERVER['DOCUMENT_ROOT'] . "/../framework/autoload.php";

$config = $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
//$app = CWebApplication::createApplication($config);

$app = \frame\CWebApplication\CWebApplication::createApplication($config);

$app ->run();

