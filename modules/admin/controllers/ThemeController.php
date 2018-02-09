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


    //上传文件
    public function actionUploadfile(){
        if(\Yii::$app->request->isPost){
//            var_dump($_FILES['file_head']);
            $files = $_FILES['file_head'];
//            move_uploaded_file($_FILES['file_head']['tmp_name'],'./upload/'.$_FILES['file_head']['name']);
            $url = \Yii::$app->params['apiUrl']."/api/v2/upload/";
            $transData = $files;
            $aa['file'] = json_encode($transData);
//            var_dump($files);
            $data = curl_post($url,$aa);
            var_dump($data);
        }
    }


}