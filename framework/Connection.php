<?php
/**
 * Created by PhpStorm.
 * User: WalkingSun
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
        if( !$condition || !$data ) return false;
        $keys = array_keys($condition);
        $bindParams = array_map(function($row){  return "{$row} = :{$row}";  },$keys);
        $where = implode(' AND ',$bindParams);

        $keys = array_keys($data);
        $bindParams = array_map(function($row){  return "{$row} = :{$row}";  },$keys);
        $update = implode(', ',$bindParams);

        $where = $where?" WHERE {$where}":'';
        $sql = "UPDATE {$table} SET {$update} {$where}";

        try {
            $statement =  self::$pdo->prepare($sql);
            $up = array_merge($data,$condition);
            $result = $statement->execute($up);
        } catch (\Exception $e) {
            throw new  \Exception($e -> getMessage ());
        }
        return $result;
    }

    public static function delete($table,$condition){

        $keys = array_keys($condition);
        $bindParams = array_map(function($row){  return "{$row} = :{$row}";  },$keys);
        $where = implode(' AND ',$bindParams);

        $where = $where?" WHERE {$where}":'';

        $sql = "DELETE FROM {$table} {$where}";

        try {
            $statement =  self::$pdo->prepare($sql);
            $result = $statement->execute($condition);
        } catch (\Exception $e) {
            throw new  \Exception($e -> getMessage ());
        }
        return $result;
    }

    public static function  select( $table,$cols = array(), $condition=array()){
        $where = '';
        if( !empty($condition) ){
            $keys = array_keys($condition);
            $bindParams = array_map(function($row){  return "{$row} = :{$row}";  },$keys);
            $where = implode(' AND ',$bindParams);
        }

        if( is_array($cols) ){
            $cols = implode(',',$cols);
        }

        $cols = $cols?:'*';
        $where = $where?" WHERE {$where}":'';
        $sql = "SELECT {$cols} FROM {$table}  {$where}";

        try {
            if( $condition ){
                $statement =  self::$pdo->prepare($sql);
                $statement->execute($condition);
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                $result = self::$pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (\Exception $e) {
            throw new  \Exception($e -> getMessage ());
        }
        return $result;
    }

}