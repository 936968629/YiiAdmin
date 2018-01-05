<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/22
 * Time: 9:42
 */

namespace app\modules\admin\controllers;

use app\models\AdminGroupModel;
use app\models\AdminModel;
use app\modules\admin\controllers\common\BaseController;

class AdminController extends BaseController
{
    //分组列表
    public function actionIndex(){
        $modelInfo = AdminModel::find()->select('bs_admin.*,g.group_name')->join('inner join','bs_admin_group g','user_type=g.id')->asArray()->all();
        return $this->render('index',[
            'modelInfo' => $modelInfo
        ]);
    }

    public function actionInfo(){
        $adminInfo = AdminModel::find()->where(['id'=>1])->asArray()->one();
        return $this->render('info',[
            'adminInfo' => $adminInfo,
        ]);
    }

    public function actionEdit(){

    }
    //分组管理
    public function actionGroup_index(){
        $modelInfo = AdminGroupModel::find()->asArray()->all();
        return $this->render('groupIndex',[
            'modelInfo' => $modelInfo
        ]);
    }
    //
    public function actionGroup_edit(){
        if(\Yii::$app->request->isPost){

        }else{
            $id = $this->get('id','','intval');
            $info = AdminGroupModel::find()->where(['id'=>$id])->one();
            return $this->render('groupEdit',[
                'info' => $info
            ]);
        }

    }

}