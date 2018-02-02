# openyii
参考yii开发的简易框架，基于MVC设计，结构清晰，有兴趣的人可以加入我们。


##目录结构
- config   配置项
   - db.php 数据库配置
   - main.php 主配置项
   - urlmanage Restful 配置
- framework  框架底层
   - lib 外部类库
- modules 应用层（mvc） 
    - controllers 控制层
    - models 模型层
    - views 视图层
        - layouts 布局
- web
    - index.php  入口

###Restful API

写在前面，restful 对url重写要求有点高，需要服务器做些处理，框架使用的是apache服务器，需要在web下添加 .htacess 文件，内容如下：
```shell
RewriteEngine on    #rewriteengine为重写引擎开关on为开启off为关闭

#如果不是真实存在的目录或文件，则分发请求给index.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule (.*)$ index.php
```
其实就是将复杂的url，如localhost/user/10 分发给index.php处理；Nginx处理，需要在

config.php 添加 
```php
 'rules' => [
        #控制器 =》 配置
        controllerId => [
            'extraPatterns' => [
                urlId => actionId,   //参数获取id匹配原actionId
               ...
            ],
        ],
```
controllerId 代表控制器id，actionId 代表动作Id，urlId 代表url中表示actionId的参数，如：
```php
 ...
        'user' => [
            'extraPatterns' => [
                'index123' => 'index',   //参数获取id匹配原actionId
               ...
            ],
        ],
 ...
```
localhost/user/index123  所指真实地址就是/user/index；

restful 以资源来定位，通过http动词来执行相应动作，主要：
```$xslt
GET /users: 逐页列出所有用户；
HEAD /users: 显示用户列表的概要信息；
POST /users: 创建一个新用户；
GET /users/123: 返回用户为 123 的详细信息;
PATCH /users/123 and PUT /users/123: 更新用户 123;
DELETE /users/123: 删除用户 123;
```
restful API 默认提供 create、delete、update、select、detail接口，需要一些处理下面会做详细说明，实际使用会更复杂，可自行添加相应action，必须在配置项 extraPattern 添加对应规则，上面已经举例。

create、delete、update、select、detail这些默认接口，是对单一的数据表结构进行操作，逻辑复杂可自己重写，启用操作如下：
1. 新增数据表操作model，继承baseModel，提供数据表
```php
namespace openyii\modules\models;

use openyii\framework\BaseModel;

class UserModel extends BaseModel
{
    public $cols = array();   //子类定义显示字段，如'id','username'

    /*提供表名*/
    public static function tableName(){

        return 'user';

    }
```
2.新增控制器提供，表操作model
```php
namespace openyii\modules\controllers;

use openyii\framework\CController;

class UserController extends CController
{
    public $modelClass = 'openyii\modules\models\UserModel';   //定义user操作model

}
```

如此，一个简易的restful接口完成，是对user用户资源的操作，需要添加复杂的接口操作，可以重写接口逻辑，或者加个接口，如：
```php
 ...
 public function actionIndex(){
        ...
        echo 'Hello World!';
    }
 ...
```




  





    
    
    
    