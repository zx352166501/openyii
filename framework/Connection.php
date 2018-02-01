<?php
/**
 * Created by PhpStorm.
 * User: mw
 * Date: 2018/1/24
 * Time: 16:18
 */

namespace openyii\framework;


class Connection
{
    public static $pdo;    //操作句柄

    public function __construct( $conifg )
    {
        $dsn = $conifg['dsn'];
        $username = $conifg['username'];
        $password = $conifg['password'];
        $option['charset'] = $conifg['charset'];
        self::init($dsn, $username, $password, $option);
    }

    protected function init( $dsn, $username, $password, $option){
        try {

            self::$pdo = new \PDO($dsn, $username, $password,array(\PDO::ATTR_PERSISTENT => true));

        } catch ( \PDOException $e ) {
            die($e -> getMessage ());
        }
    }

    public static function insert($table, $data)
    {
        $sql = sprintf(
            'insert into %s(%s) values(%s)',
            $table,
            implode(', ', array_keys($data)),
            ':' . implode(', :', array_keys($data))
        );

        try {
            $statement =  self::$pdo->prepare($sql);
            $result = $statement->execute($data);
        } catch (\Exception $e) {
            throw new  \Exception($e -> getMessage ());
        }
        return $result;
    }

    public static function update($table,$data,$condition){

        $str = array_reduce($data,function($key,$value){  static $r=''; $r.= "\'{$key}\' = :{$key},";return $r; });
        $where = array_reduce($condition,function($key,$value){  static $r=''; $r.= "\'{$key}\' = \'{$value}\',";return $r; });
        $str = substr($str,0,-1);
        $where = substr($where,0,-1);

        $sql = "UPDATE {$table} SET {$str} WHERE {$where}";

        try {
            $statement =  self::$pdo->prepare($sql);
            $result = $statement->execute($data);
        } catch (\Exception $e) {
            throw new  \Exception($e -> getMessage ());
        }
        return $result;
    }

    public static function delete($table,$condition){

        $where = array_reduce($condition,function($key,$value){  static $r=''; $r.= "\'{$key}\' = :{$key},";return $r; });
        $where = substr($where,0,-1);

        $sql = "DELETE FROM {$table}  WHERE {$where}";

        try {
            $statement =  self::$pdo->prepare($sql);
            $result = $statement->execute($condition);
        } catch (\Exception $e) {
            throw new  \Exception($e -> getMessage ());
        }
        return $result;
    }

    public static function  select( $table,$cols = array(), $condition=array()){
        $where = array_reduce($condition,function($key,$value){  static $r=''; $r.= "\'{$key}\' = :{$key},";return $r; });
        $where = $where?substr($where,0,-1):'';

        if( is_array($cols) ){
            $cols = implode(',',$cols);
        }

        $cols = $cols?:'*';
        $where = $where?' WHERE {$where}':'';
        $sql = "SELECT {$cols} FROM {$table}  {$where}";

        try {
            if( $condition ){
                $statement =  self::$pdo->prepare($sql);
                $result = $statement->execute($condition);
            }else{
                $result = self::$pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (\Exception $e) {
            throw new  \Exception($e -> getMessage ());
        }
        return $result;
    }

}