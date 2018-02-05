<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 15:28
 */

return [

    "defaultController" =>"index",
    "defaultAction" =>"index",
    'defaultRoute'=>'index/index',

    "name" =>"my Application",

    'db' => require(__DIR__ . '/../config/db.php'),
//    'urlManager' => require(__DIR__ . '/urlmanage.php'),    //启用restful
    'params' => require(__DIR__ . '/params.php'),

];