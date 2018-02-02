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

    /**
     *
     * @return array 查询列表
     */
    public function lists(){
        $table = static::tableName();

        $cols = array();
        $method = base::$app->request->method;
        $condition = base::$app->request->$method ;
        return Connection::select($table,$cols,$condition);
    }

    /**
     * 根据id
     * @return array 查询明细
     */
    public function detail(){
        $table = static::tableName();
        $method = base::$app->request->method;
        $condition = base::$app->request->$method;
        if( empty($condition['id']) ){
            return false;
        }
        $cols = array();
        return Connection::select($table,$cols,$condition);
    }

    /**
     * 新增记录
     * @return bool
     */
    public function add(){
        $table = static::tableName();
        $method = base::$app->request->method;
        $data = base::$app->request->$method;
        return Connection::insert($table,$data);
    }

    /**
     * 更新记录记录
     * @return bool
     */
    public function update(){
        $table = static::tableName();
        $method = base::$app->request->method;
        $id =  base::$app->request->get['id'];
        $data = base::$app->request->$method;
        $condition = ['id'=>$id];
        return Connection::update($table,$data,$condition);
    }

    /**
     * 删除记录
     * @return bool
     */
    public function delete(){
        $table = static::tableName();
        $method = base::$app->request->method;
        $id = base::$app->request->get['id'];
//        $data = base::$app->request->$method;
        $condition = ['id'=>$id];
        return Connection::delete($table,$condition);
    }
}