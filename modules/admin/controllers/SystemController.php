<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 14:19
 */

namespace app\modules\admin\controllers;


use app\models\AdminMenuModel;
use app\modules\admin\controllers\common\BaseController;

class SystemController extends BaseController
{
    /*菜单管理*/
    public function actionMenu(){
        $adminMenu = AdminMenuModel::find()->where(['parent_id' => 0])->orderBy('list')->asArray()->all();
        foreach ($adminMenu as &$item){
            $adminchildMenu = AdminMenuModel::find()->where(['parent_id'=>$item['id'] ])->orderBy('list')->asArray()->all();
            if(!empty($adminchildMenu)){
                $item['child'] = $adminchildMenu;
            }
        }
        return $this->render('menu',[
            'modelInfo' => $adminMenu
        ]);
    }



}