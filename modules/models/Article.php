<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 10:05
 */
namespace openyii\modules\models;

use openyii\framework\CModel;

class Article extends CModel
{
    public static $model;

    public function __construct()
    {
        $this::createApplication();
    }

    /**
     * 获取文章信息
     * @return array
     */
    public function find(){

        $query = " select * from ts_article where article_id = 1";
        return $this::GetOneDataInfo($query);
//        return $this::GetAllDataInfo($query);

    }



}