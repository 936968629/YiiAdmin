<?php
namespace app\modules\admin\controllers;

use app\models\BannerItemModel;
use app\modules\admin\controllers\common\BaseController;

class BannerController extends BaseController {

    public function actionIndex(){
        $datalist = BannerItemModel::find()
            ->where(['type'=>1])
            ->asArray()
            ->all();
        return $this->render('index',[
            'datalist'=>$datalist
        ]);
    }

    public function actionAdd(){
        if(\Yii::$app->request->isPost){

        }else{
            return $this->render('add');
        }
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){

        }else{
            $id = $this->get('id',1,'intval');
            $info = BannerItemModel::find()
                ->where(['id'=>$id])
                ->one();
            return $this->render('edit',[
                'info'=>$info
            ]);
        }
    }
}