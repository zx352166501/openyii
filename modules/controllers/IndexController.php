<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 10:04
 */

//require $_SERVER['DOCUMENT_ROOT']."/framework/CController.php";
require $_SERVER['DOCUMENT_ROOT']."/modules/models/Article.php";


class IndexController extends CController
{

    /**
     * 首页
     */
    public function actionIndex(){

        $article = new Article();
        $findRes = $article ->find();
        $this ->render('index/index',array('result'=>$findRes));

    }

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
