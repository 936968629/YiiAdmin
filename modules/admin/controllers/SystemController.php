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
            return "da";
        }else{
            $model = AdminMenuModel::find();
            if( ApiTools::editStatus($model,$status,['id'=>$id]) ){
                $this->error('da');
//                $this->redirect(\Yii::$app->request->referrer);//返回上一页
            }else{

            }
        }
    }

}