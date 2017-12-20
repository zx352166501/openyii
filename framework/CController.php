<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 9:58
 */

class CController {

    /**
     * 加载指定目录的模板文件，并且将控制器中数据传入到试图文件中
     * @param $viewName
     * @param $data
     * @return mixed
     */
    public function render($viewName,$data){

        extract($data,EXTR_PREFIX_SAME,'data');  // 将data变为变量形式
        require $_SERVER['DOCUMENT_ROOT'].'/modules/views/'.$viewName.".php";   // 包含试图文件

    }


    /**
     * 加载指定目录的模板文件，并且将控制器中数据传入到试图文件中
     * @param $viewName
     * @param $data
     * @return mixed
     */
    public function redirect($viewName,$data = null){

        $str = "";
        if($data){
            foreach ($data as $key =>$val){
                $str = $str."&".$key." = ".$val;
            }
        }
        header("Location:".$_SERVER['SCRIPT_NAME']."?r=".$viewName.$str);
        die();

    }

}