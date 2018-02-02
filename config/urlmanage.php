<?php
/**
 * Created by PhpStorm.
 * User: walkingsun
 * Date: 2018/1/18
 * Time: 14:04
 */
return array(
    'enablePrettyUrl' => true,   // todo 路由美化
    'enableStrictParsing' => true,  //todo 严格检查路由美化,后缀加s
    'cache' => false, //todo 关闭路由缓存
    'rules' => [
        //控制器 =》 配置
        'user' => [
            'extraPatterns' => [
                'index' => 'index',   //参数获取id匹配原actionId
                'login' => 'login'
            ],
        ],

    ]
);

