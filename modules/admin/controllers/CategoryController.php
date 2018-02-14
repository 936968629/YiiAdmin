<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/14
 * Time: 15:02
 */

namespace app\modules\admin\controllers;


use app\common\tools\ApiTools;
use app\models\CategoryModel;
use app\modules\admin\controllers\common\BaseController;

class CategoryController extends BaseController
{
    public function actionIndex(){
        $info = CategoryModel::find()->asArray()->all();

        return $this->render('index',[
            'datalist' => $info
        ]);
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){

        }else{

            return $this->render('edit',[

            ]);
        }
    }

    public function actionAdd(){

    }

    public function actionEdit_status(){
        $id = $this->get('id','','intval');
        $status = $this->get('status','1','intval');
        if(empty($id)) {
            return $this->renderJson(995);
        }else{
            $model = CategoryModel::find();
            if( ApiTools::editStatus($model,$status,['id'=>$id]) ){
                return $this->renderJson(1);
            }
            return $this->renderJson(0);
        }
    }
}