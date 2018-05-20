<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/2 0002
 * Time: 8:57
 */

namespace app\modules\admin\controllers\common;


use app\common\components\BasePublicController;
use app\models\AdminGroupModel;
use app\models\AdminMenu;
use app\models\AdminMenuModel;
use app\models\AdminModel;

class BaseController extends BasePublicController
{
    public $no_use_login = [
        'default/index',
        'default/login',
        'default/login-act',
        'user/logout'
    ];

    public $use_layout = [
        'index/index'
    ];

    public function beforeAction($action)
    {
        $controller = $action->controller->id;
        $method = $action->id;
        $permissionRoute = $controller."/".$method;
        if(!in_array($permissionRoute,$this->no_use_login)){
            if(in_array($permissionRoute,$this->use_layout)){
                $this->layout = "main";
            }else{
                $this->layout = false;
            }
            //未登录
            if(empty($_SESSION['admin'])){
                //跳转到首页登录
                $this->redirect(['default/login']);
                return false;
            }
            $view = \Yii::$app->view;
            $admin_id = $_SESSION['admin'];
            $adminInfo = AdminModel::find()->where(['id'=>$admin_id])->one();
            if($adminInfo['user_type'] != 1){
                //非管理员
                $url = $controller."/".$method;
                $adminGroup = AdminGroupModel::find()->where(['id'=>$adminInfo['user_type'] ] )->one();
                $menuGroup = AdminMenuModel::find()->where(['url'=>$url])->one();
                $arr = explode(',',$adminGroup['menu_auth']);
                if( !in_array($menuGroup['id'],$arr ) ){
                    echo "权限不够";
                    return false;
                }
            }

            $view->params['breadCrumbs'] = $this->getBreadcrumbs($permissionRoute);
            $view->params['admin_name'] = \Yii::$app->session->get('admin');
            return true;
        }
        $this->layout = false;
        return true;

    }

    //获取管理员信息
    private function getAdminInfo(){

    }

    /**
     * 获取后台面包屑
     * @param $url
     * @return array|bool
     * @author wjl
     */
    private function getBreadcrumbs($url){
        if(empty($url)){
            return false;
        }
        $currntMenuInfo = AdminMenuModel::find()->where(['url'=>$url])->one();
        if(empty($currntMenuInfo)){
            return false;
        }
        $parentMenu[] = $currntMenuInfo['name'];
        while($currntMenuInfo['parent_id'] != 0){
            $parentMenuInfo = AdminMenuModel::find()->where(['id'=>$currntMenuInfo['parent_id']])->one();
            array_unshift($parentMenu,$parentMenuInfo['name']);
            $currntMenuInfo = $parentMenuInfo;
        }
        return $parentMenu;
    }

}