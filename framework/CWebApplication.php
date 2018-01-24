<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 15:13
 */

namespace openyii\framework;
use openyii\modules\controllers;
use openyii\framework\CRequest;
use openyii\framework\base;


class CWebApplication
{
    private static $_app;

    private function __construct($config=null){
        //获取配置文件
        if(is_string($config));
            $config = require $config;

        if(is_array($config)){
            foreach ($config as $key =>$val){
                $this ->$key = $val;
            }
        }

    }

    /**
     * 静态方法用于创建它本身的静态私有对象
     * @return CWebApplication
     */
    public static function createApplication($config=null){

        if(self::$_app == null){
            self::$_app = new CWebApplication($config);
        }
        return self::$_app;

    }

    public static function app(){
        return self::$_app;
    }


    /**
     * 创建application执行方法
     */
    public function run(){

        $config = self::$_app;

        CRequest::init();

        base::$app->request = CRequest::$queryParams;

        if( isset($config->db) ){
          new Connection( $config->db );
        }


        if( CRequest::$route ){
            self::commonSite(CRequest::$route);
        }else{
            $this::defaultSite();
        }

    }


    /**
     * 站点跳转方法
     * @param $route
     */
    private static function commonSite($route){

        header("Content-type: text/html; charset=utf-8");
        $pos = strpos($route,'/');   // 查找字符串在另一字符串中第一次出现的位置

        $defaultController = substr($route,0,$pos);
        $defaultController = strtolower($defaultController); //  把所有字符转换为小写
        $defaultAction = (string) substr($route,$pos+1);

        $className = ucfirst($defaultController)."Controller";      // 函数把字符串中的首字符转换为大写
        $classFile = __DIR__."/../modules/controllers/".$className.".php";

        if(is_file($classFile)){

            if(!class_exists($className,false)){

                require $classFile;

                $className = "openyii\\modules\\controllers\\".$className;
                $class = new $className;
                $functionName = "action".ucfirst($defaultAction);

                if(!method_exists($class,$functionName)){
                    echo '未定义'.$functionName.'方法！';

                }else{
                    $class ->$functionName();
                }
            }

        }else{

            self::commonSite("index/error");

        }

    }


//    /**
//     * 站点跳转方法
//     * @param $route
//     */
//    private static function commonSite($route){
//
//        header("Content-type: text/html; charset=utf-8");
//        $pos = strpos($route,'/');   // 查找字符串在另一字符串中第一次出现的位置
//
//        $defaultController = substr($route,0,$pos);
//        $defaultController = strtolower($defaultController); //  把所有字符转换为小写
//        $defaultAction = (string) substr($route,$pos+1);
//
//        $className = ucfirst($defaultController)."Controller";      // 函数把字符串中的首字符转换为大写
//        $classFile = __DIR__."/modules/controllers/".$className.".php";
//
//        if(is_file($classFile)){
//
//            if(!class_exists($className,false)){
//
//                require $classFile;
//                $class = new $className;
//                $functionName = "action".ucfirst($defaultAction);
//
//                if(!method_exists($class,$functionName)){
//                    echo '未定义'.$functionName.'方法！';
//
//                }else{
//                    $class ->$functionName();
//                }
//
//
//            }
//
//        }else{
//
//            self::commonSite("index/error");
//
//        }
//
//    }


    /**
     * 默认路由设置
     */
    private static function defaultSite(){

        $route = trim(self::$_app ->defaultRoute);

        if($route ==""){
            $route = 'index/index';
        }

        self::commonSite($route);

    }


}