<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/6
 * Time: 16:07
 */

namespace app\modules\admin\controllers;


use app\models\ThemeModel;
use app\modules\admin\controllers\common\BaseController;

class ThemeController extends BaseController
{
    public function actionIndex(){
        $datalist = ThemeModel::find()->asArray()->all();

        return $this->render('index',[
            'datalist' => $datalist,
        ]);
    }

    //修改
    public function actionEdit(){
        if(\Yii::$app->request->isPost){
            $id = $this->post('id','','intval');
            $name = $this->post('name','','op_t');
            $description = $this->post('description','','op_t');
            $info = ThemeModel::find()->where(['id'=>$id])->one();
            $info->name = $name;
            $info->description = $description;
            $ret = $info->save();
            if(!$ret){
                return $this->renderJson(0);
            }
            return $this->renderJson(1);
        }else{
            $id = $this->get('id','','op_t');
            $info = ThemeModel::find()
                    ->where(['id'=>$id])
                    ->asArray()
                    ->one();
            return $this->render('edit',[
                'info' => $info,
            ]);
        }
    }





}