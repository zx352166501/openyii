<?php
/**
 * Created by PhpStorm.
 * User: walkingsun
 * Date: 2018/1/18
 * Time: 10:45
 */

namespace openyii\framework;


class CRequest
{
//    private static $method = array( 'get','post','put','head','options','patch','delete' );
    public static $queryParams;   //参数
    public static $route;   //路由
    public static $method;   //请求方式

    public static function init()
    {
       self::getUrl();
    }

    /**
     * get url params
     */
    public static function getUrl(){
        $REQUEST_URI = $_SERVER['REQUEST_URI'];
        self::$queryParams = new \stdClass();
        $paths = parse_url($REQUEST_URI);
        if( $paths['path']!='/' ) {
            self::$route = $paths['path'];
        }

        if( isset($paths['query']) ){
            parse_str($paths['query'],$params);
            if(isset($params['r']))  self::$route = $params['r'];
            self::$queryParams->get = $params;
        }

        //参考  https://www.cnblogs.com/zhepama/p/4022606.html  post获取数据方式【file_get_contents("php://input") 适用大多数类型的Content-type 不能用于 enctype="multipart/form-data"】
         $method = $_SERVER['REQUEST_METHOD'];

         self::$queryParams->$method = file_get_contents("php://input");

    }




}