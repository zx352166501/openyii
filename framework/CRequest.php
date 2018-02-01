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

    public static function init( $config )
    {
        $urlManager = isset($config->urlManager)?$config->urlManager:'';
       self::getUrl( $urlManager );
    }

    /**
     * get url params
     */
    public static function getUrl( $urlManager ){
        $REQUEST_URI = $_SERVER['REQUEST_URI'];
        self::$queryParams = new \stdClass();
        $paths = parse_url($REQUEST_URI);
        if( $paths['path']!='/' ) {
            self::$route = trim($paths['path'],'/');
            self::$queryParams->get = [];
        }

        if( isset($paths['query']) ){
            parse_str($paths['query'],$params);
            if(isset($params['r']))  self::$route = $params['r'];
            self::$queryParams->get = $params;
        }

        //参考  https://www.cnblogs.com/zhepama/p/4022606.html  post获取数据方式【file_get_contents("php://input") 适用大多数类型的Content-type 不能用于 enctype="multipart/form-data"】
         self::$method = $method = strtolower( $_SERVER['REQUEST_METHOD'] );
        if( $method!='get' ){
            self::$queryParams->$method =  file_get_contents("php://input");
        }

        //如果开启restful Api,则进行路由解析
        if( !empty($urlManager['rules']) ){
            $r = explode('/',self::$route);
            $resource = $r[0];
            $actid = isset($r[1])?$r[1]:'';

            //非额外的规则 重写路由
            if( !isset($urlManager['rules'][$resource]['extraPatterns'][$actid]) ){
                switch ( $method ){
                    case 'get':
                        if( $actid ){
                            self::$queryParams->$method += array('id'=>$actid);
                            $actid = 'detail';
                        }else{
                            $actid = 'list';
                        }
                        break;
                    case 'post':
                        $actid = 'create';
                        break;
                    case 'patch':
                        self::$queryParams->$method += array('id'=>$actid);
                        $actid = 'update';
                        break;
                    case 'delete':
                        self::$queryParams->$method += array('id'=>$actid);
                        $actid = 'delete';
                        break;
                    default:
                }

                self::$route = $resource.'/'.$actid;
            }
        }

//        print_r(self::$route);die;
    }

/**
 * GET /users: 逐页列出所有用户；
HEAD /users: 显示用户列表的概要信息；
POST /users: 创建一个新用户；
GET /users/123: 返回用户为 123 的详细信息;
HEAD /users/123: 显示用户 123 的概述信息;
PATCH /users/123 and PUT /users/123: 更新用户 123;
DELETE /users/123: 删除用户 123;
OPTIONS /users: 显示关于末端 /users 支持的动词;
OPTIONS /users/123: 显示有关末端 /users/123 支持的动词。
 */


}