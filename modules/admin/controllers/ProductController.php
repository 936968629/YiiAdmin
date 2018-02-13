<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/6
 * Time: 14:58
 */

namespace app\modules\admin\controllers;


use app\common\tools\ApiTools;
use app\models\ProductModel;
use app\modules\admin\controllers\common\BaseController;

class ProductController extends BaseController
{
    public function actionIndex(){
        $datalist = ProductModel::find()->asArray()->all();

        return $this->render('index',[
            'datalist' => $datalist
        ]);
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){

        }else{
            $id = $this->get('id','','op_t');
            $info = ProductModel::find()
                ->where(['id'=>$id])
                ->asArray()
                ->one();

            return $this->render('edit',[
                'info' => $info
            ]);
        }

    }

    public function actionAdd(){
        if(\Yii::$app->request->isPost){

        }else{
            return $this->render('add');
        }
    }

    //修改状态
    public function actionEdit_status(){
        $id = $this->get('id','','intval');
        $status = $this->get('status','1','intval');
        if(empty($id)){
            return $this->renderJson(995);
        }else{
            $model = ProductModel::find();
            if( ApiTools::editStatus($model,$status,['id'=>$id]) ){
                return $this->renderJson(1);
            }else{
                return $this->renderJson(994);
            }
        }
    }
}