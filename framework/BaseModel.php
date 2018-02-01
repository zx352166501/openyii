<?php
/**
 * Created by PhpStorm.
 * User: mw
 * Date: 2018/2/1
 * Time: 18:17
 */

namespace openyii\framework;


class BaseModel
{

    public function lists(){
        $table = static::tableName();

        $cols = array();
        $method = base::$app->request->method;
        $condition = base::$app->request->$method ;
        return Connection::select($table,$cols,$condition);
    }



}