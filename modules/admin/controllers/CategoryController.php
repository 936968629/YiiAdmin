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
            $id = $this->post('id','0','intval');
            $name = $this->post('name','','op_t');
            $info = CategoryModel::find()->where(['id'=>$id])->one();
            $info->name = $name;
            $ret = $info->save();
            if(!$ret){
                return $this->renderJson(0);
            }
            return $this->renderJson(1);
        }else{
            $id = $this->get('id','','intval');
            $info = CategoryModel::find()
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
            $name = $this->post('name','','op_t');
            $url = $this->post('img','','op_t');
            if(empty($name) || empty($url)){
                return $this->renderJson(3000);
            }
            $category = new CategoryModel();
            $category->name = $name;
            $category->topic_img = $url;
            $ret = $category->save();
            if(!$ret){
                return $this->renderJson(0);
            }
            return $this->renderJson(1);
        }else{
            return $this->render('add');
        }
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