<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/25
 * Time: 10:08
 */

require __DIR__ . "/../framework/CWebApplication.php";
require __DIR__. "/../framework/autoload.php";

$config = __DIR__ . "/../config/main.php";

$app = \openyii\framework\CWebApplication::createApplication($config);
spl_autoload_register(array('Autoload', 'loadClass'));

$app ->run();

