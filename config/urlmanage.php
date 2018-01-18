<?php
/**
 * Created by PhpStorm.
 * User: walkingsun
 * Date: 2018/1/18
 * Time: 14:04
 */
return array(
    [
        'enablePrettyUrl' => true,   // 路由美化
        'enableStrictParsing' => true,  // 严格检查路由美化,后缀加s
        'showScriptName' => false,
        'cache' => false, // 关闭路由缓存
        'rules' => [
            ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],]
    ],

);

