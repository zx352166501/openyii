<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/25
 * Time: 10:08
 */

require $_SERVER['DOCUMENT_ROOT'] . "/../framework/CWebApplication.php";
require $_SERVER['DOCUMENT_ROOT'] . "/../framework/autoload.php";

$config = $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";

$app = \openyii\framework\CWebApplication::createApplication($config);
spl_autoload_register(array('Autoload', 'loadClass'));

$app ->run();

