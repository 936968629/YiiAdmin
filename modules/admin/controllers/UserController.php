<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/22
 * Time: 9:39
 */

namespace app\modules\admin\controllers;


use app\common\tools\ApiTools;
use app\models\UserModel;
use app\modules\admin\controllers\common\BaseController;

class UserController extends BaseController
{
    public function actionIndex(){
        $datalist = UserModel::find()
            ->all();

        return $this->render('index',[
            'datalist' => $datalist
        ]);
    }

    public function actionEdit_status(){
        $id = $this->get('id','','intval');
        $status = $this->get('status',1,'intval');
        if(empty($id)){
            return $this->renderJson(995);
        }else{
            $model = UserModel::find();
            if( ApiTools::editStatus($model,$status,['id'=>$id]) ){
                return $this->renderJson(1);
            }else{
                return $this->renderJson(994);
            }
        }
    }
    //注销
    public function actionLogout(){
        unset($_SESSION['admin'] );
        $this->redirect('/admin/default/login');
    }

    //显示二维码
    public function actionCode(){
        include_once \Yii::$app->basePath."\common\\tools\phpqrcode.php";
        $value="55";
        $errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
        $matrixPointSize = "4"; //生成图片大小 ：1到10
        \QRcode::png($value,false,$errorCorrectionLevel,$matrixPointSize);
        exit();
    }
}