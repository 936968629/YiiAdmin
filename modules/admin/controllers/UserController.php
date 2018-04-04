<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/22
 * Time: 9:39
 */

namespace app\modules\admin\controllers;


use app\modules\admin\controllers\common\BaseController;

class UserController extends BaseController
{
    
    public function actionIndex(){

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