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
    public static function tableName(){

        return 'user';

    }



}