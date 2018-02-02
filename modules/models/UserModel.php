<?php
/**
 * Created by PhpStorm.
 * User: mw
 * Date: 2018/2/1
 * Time: 18:11
 */

namespace openyii\modules\models;


use openyii\framework\BaseModel;
use openyii\framework\Connection;

class UserModel extends BaseModel
{
    public $cols = array();   //子类定义显示字段，如'id','username'

    public static function tableName(){

        return 'user';

    }




}