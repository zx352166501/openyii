<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 9:58
 */
namespace openyii\framework;

use openyii\modules\models\UserModel;

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
            require __DIR__.'/../modules/views/layouts/'.$this->layouts."/header.php";
            $this ->renderPartical($viewName,$data);
            return require __DIR__.'/../modules/views/layouts/'.$this->layouts."/footer.php";

        }

    }

    public function renderOld($viewName,$data){
        // 跳转不关联layouts
        extract($data,EXTR_PREFIX_SAME,'data');
        return require __DIR__.'/modules/views/'.$viewName.".php";   // 包含试图文件
    }

    /**
     * 加载指定目录的模板文件，并且将控制器中数据传入到试图文件中
     * @param $viewName
     * @param $data
     * @return mixed
     */
    public function renderPartical($viewName,$data){

        extract($data,EXTR_PREFIX_SAME,'data');  // 将data变为变量形式
        return require __DIR__.'/../modules/views/'.$viewName.".php";   // 包含试图文件

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

    public function actionList(){
       try{
           $model = $this->modelClass;
           $model_new = new $model;

           $result = $model_new->lists();
       }catch(\Exception $e){
           $msg = $e->getMessage();
           return self::echoJson('500',$msg);
       }

        return self::echoJson('200','success',$result);
    }

    public function actionDetail(){
        try{
            $model = $this->modelClass;
            $model_new = new $model;

            $result = $model_new->detail();
        }catch(\Exception $e){
            $msg = $e->getMessage();
            return self::echoJson('500',$msg);
        }

        return self::echoJson('200','success',$result);
    }
    public function actionCreate(){
        try{
            $model = $this->modelClass;
            $model_new = new $model;

            $result = $model_new->add();
        }catch(\Exception $e){
            $msg = $e->getMessage();
            return self::echoJson('500',$msg);
        }

        return self::echoJson('200','success',$result);
    }

    public function actionUpdate(){
        try{
            $model = $this->modelClass;
            $model_new = new $model;

            $result = $model_new->update();
        }catch(\Exception $e){
            $msg = $e->getMessage();
            return self::echoJson('500',$msg);
        }

        return self::echoJson('200','success',$result);
    }

    public function actionDelete(){
        try{
            $model = $this->modelClass;
            $model_new = new $model;

            $result = $model_new->delete();
        }catch(\Exception $e){
            $msg = $e->getMessage();
            return self::echoJson('500',$msg);
        }

        return self::echoJson('200','success',$result);
    }

    public function echoJson($code,$msg,$data){
        $dd = [
            'code'   =>   $code,
            'msg'   =>   $msg,
            'data'   =>   $data,
        ];
        $result = json_encode($dd);
        echo $result;
    }

}