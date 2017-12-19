<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/2 0002
 * Time: 8:57
 */

namespace app\modules\admin\controllers\common;


use app\common\components\BasePublicController;

class BaseController extends BasePublicController
{
    public $no_use_login = [
        'default/index',
        'default/login',
        'default/login-act'
    ];
    
    public function beforeAction($action)
    {
        $this->layout = false;

        $controller = $action->controller->id;
        $method = $action->id;
        $permissionRoute = $controller."/".$method;
        //未登录
        if(!in_array($permissionRoute,$this->no_use_login)){
            if(empty($_SESSION['admin'])){
                //跳转到首页登录
                $this->redirect(['default/login']);
                return false;
            }
            return true;
        }
        return true;
     //   return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
}