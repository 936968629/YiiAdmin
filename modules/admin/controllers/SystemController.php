<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 14:19
 */

namespace app\modules\admin\controllers;


use app\common\tools\ApiTools;
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



    //修改状态
    public function actionEdit_status(){
        $id = $this->get('id','','intval');
        $status = $this->get('status','1','intval');
        if(empty($id)){
//            return $this->error("id参数错误");
            return $this->renderJson(995);
        }else{
            $model = AdminMenuModel::find();
            if( ApiTools::editStatus($model,$status,['id'=>$id]) ){
                return $this->renderJson(1);
//                $this->redirect(\Yii::$app->request->referrer);//返回上一页
            }else{
//                return $this->error('没有找到该数据');
                return $this->renderJson(994);
            }
        }
    }

}