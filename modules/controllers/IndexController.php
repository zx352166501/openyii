<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 10:04
 */


namespace frame\modules\controllers;

require $_SERVER['DOCUMENT_ROOT']."/../modules/models/Article.php";

use frame\CController\CController;
use frame\modules\models\Article;

class IndexController extends CController
{
     public $layouts = 'main';
    /**
     * 首页
     */
    public function actionIndex(){

        $article = new Article();
        $findRes = $article ->find();
        return $this ->render('index/index',array('result'=>$findRes));

    }

    /**
     * 列表页
     */
    public function actionList(){

        $data = array(
            'refrence'=>'index/article',
            'test'=>'zx',
        );
        $this ->redirect("index/article",$data);

    }

    public function actionArticle(){

        var_dump($_GET);

    }

    public function actionError(){

        echo "404!!!";

    }

}
