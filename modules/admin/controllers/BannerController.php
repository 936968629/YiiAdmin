<?php
namespace app\modules\admin\controllers;

use app\common\tools\ApiTools;
use app\models\BannerItemModel;
use app\modules\admin\controllers\common\BaseController;

class BannerController extends BaseController {

    public function actionIndex(){
        $datalist = BannerItemModel::find()
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
            $id = $this->post('id','','intval');
            $type = $this->post('type','','intval');
            $keyword = $this->post('keyword','','intval');
            $info = BannerItemModel::find()
                ->where(['id'=>$id])
                ->one();
            if($type == 0){
                $info->type = $type;
            }else{
                $info->type = $type;
                $info->key_word = $keyword;
            }
            $ret = $info->save(0);
            return $this->renderJson($ret);
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

    public function actionEdit_status(){
        $id = $this->get('id','','intval');
        $status = $this->get('status',1,'intval');
        if(empty($id)){
            return $this->renderJson(995);
        }else{
            $model = BannerItemModel::find();
            if( ApiTools::editStatus($model,$status,['id'=>$id]) ){
                return $this->renderJson(1);
            }else{
                return $this->renderJson(994);
            }
        }
    }
}