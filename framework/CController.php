<?php
/**
 * Created by PhpStorm.
 * User: zhangxin
 * Date: 2017/12/18
 * Time: 9:58
 */
namespace openyii\framework;

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

    /**
     * 返回统一的json数据格式
     * @param int $status ：状态码
     * @param string $message : 提示信息
     * @param mixed $data : 对象，数组，字符串等数据
     * @return string
     */
    public  function echoJson($status, $message = '', $data = '')
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        header("Content-type: application/json;charset=utf-8");
        $result['status'] = $status;
        $result['message'] = $message;
        $result['data'] = $data;
        echo self::json_en($result);
    }

    // 数组转json，解除中文转换问题
    public static function json_en($array)
    {
        $_urlencode = function (&$str) {
            if ($str !== true && $str !== false && $str !== null) {
                if (stripos($str, '"') !== false || stripos($str, '\\') !== false || stripos($str, '/') !== false ||
                    stripos($str, '\b') !== false || stripos($str, '\f') !== false || stripos($str, '\n') !== false ||
                    stripos($str, '\r') !== false || stripos($str, '\t') !== false) {
                    $newstr = '';
                    for($i=0;$i<strlen($str);$i++){
                        $c = $str[$i];
                        switch ($c) {
                            case '"':
                                $newstr .="\\\"";
                                break;
                            case '\\':
                                $newstr .="\\\\";
                                break;
                            case '/':
                                $newstr .="\\/";
                                break;
                            case '\b':
                                $newstr .="\\b";
                                break;
                            case '\f':
                                $newstr .="\\f";
                                break;
                            case '\n':
                                $newstr .="\\n";
                                break;
                            case '\r':
                                $newstr .="\\r";
                                break;
                            case '\t':
                                $newstr .="\\t";
                                break;
                            default:
                                $newstr .=$c;
                        }
                    }
                    $str = $newstr;
                }
                $str = urlencode($str);
            }
        };
        array_walk_recursive($array, $_urlencode);
        $json = json_encode($array);
        return urldecode($json);
    }

}