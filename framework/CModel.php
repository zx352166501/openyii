<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/20
 * Time: 9:27
 */
namespace openyii\framework;

use PDO;

class CModel
{

    private static $_app;

    public  function __construct(){
        //获取配置文件
        $config = require $_SERVER['DOCUMENT_ROOT']."/../config/db.php";

        foreach ($config as $key =>$val){
            $this ->$key = $val;
        }

    }

    /**
     * 静态方法用于创建它本身的静态私有对象
     * @return CWebApplication
     */
    public static function createApplication(){

        if(self::$_app == null){
            self::$_app = new CModel();
        }

        return self::$_app;

    }

    private static function app(){
        return self::$_app;
    }


    /**
     * 获取数据表单条数据
     * @param $host
     * @param $dbname
     * @param $user
     * @param $password
     * @return string
     * $host,$dbname,$user,$password,$sql
     */
    public function GetOneDataInfo($sql){

        try {

            $con = new PDO(self::app()->dsn, self::app()->username , self::app()->password);
            $con->query("set names".self::app()->charset.";");
            $res = $con ->query($sql);
            $con = null;
            $fetchRes['isok'] = true;
            $fetchRes['message'] = $res->fetch(PDO::FETCH_ASSOC);

        }catch (\Exception $ex){
            $fetchRes['isok'] = false;
            $fetchRes['message'] = '数据库连接失败'.$ex->getMessage();
        }
        return $fetchRes;

    }


    /**
     * 获取多条数据
     * @param $host
     * @param $dbname
     * @param $user
     * @param $password
     * @param $sql
     * @return string
     */
    public function GetAllDataInfo($sql){

        try {

            $con = new PDO(self::app()->dsn, self::app()->username , self::app()->password);
            $con->query("set names".self::app()->charset.";");
            $res = $con ->query($sql);
            $con = null;

            $fetchRes['isok'] = true;
            $fetchRes['message'] = $res->fetchall(PDO::FETCH_ASSOC);


        }catch (\Exception $ex){
            $fetchRes['isok'] = false;
            $fetchRes['message'] = '数据库连接失败'.$ex->getMessage();
        }
        return $fetchRes;
    }


    /**
     * 同步本地数据
     */
    public function SynDataToMysql($sql){


        try {

            $con = new PDO(self::app()->dsn, self::app()->username , self::app()->password);
            $con->query("set names".self::app()->charset.";");
            $res = $con ->exec($sql);
            $con = null;
            if($res == 0){
                throw new \Exception("同步数据失败！");
            }else{
                return "success";
            }

        }catch (\Exception $ex){
            return '数据库连接失败'.$ex->getMessage();
        }

    }


}