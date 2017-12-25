<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 9:58
 */
namespace frame\CController;

class CController {

    public $layouts;

    /**
     * 加载指定目录的模板文件，并且将控制器中数据传入到试图文件中,并且加载layouts
     * @param $viewName
     * @param $data
     * @return mixed
     */
    public function render($viewName,$data){

        if(!$this ->layouts){

            return $this ->renderPartical($viewName,$data);

        }else{

            extract($data,EXTR_PREFIX_SAME,'data');

            // todo 新增头部信息
            require $_SERVER['DOCUMENT_ROOT'].'/../modules/views/layouts/'.$this->layouts."/header.php";
            $this ->renderPartical($viewName,$data);
            return require $_SERVER['DOCUMENT_ROOT'].'/../modules/views/layouts/'.$this->layouts."/footer.php";

        }

    }

    public function renderOld($viewName,$data){
        // 跳转不关联layouts
        extract($data,EXTR_PREFIX_SAME,'data');
        return require $_SERVER['DOCUMENT_ROOT'].'/modules/views/'.$viewName.".php";   // 包含试图文件
    }

    /**
     * 加载指定目录的模板文件，并且将控制器中数据传入到试图文件中
     * @param $viewName
     * @param $data
     * @return mixed
     */
    public function renderPartical($viewName,$data){

        extract($data,EXTR_PREFIX_SAME,'data');  // 将data变为变量形式
        return require $_SERVER['DOCUMENT_ROOT'].'/../modules/views/'.$viewName.".php";   // 包含试图文件

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