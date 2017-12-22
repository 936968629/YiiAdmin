<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/22
 * Time: 9:42
 */

namespace app\modules\admin\controllers;

use app\common\tools\ApiTools;
use app\models\AdminModel;
use app\modules\admin\controllers\common\BaseController;

class AdminController extends BaseController
{

    public function actionIndex(){
        $modelInfo = AdminModel::find()->asArray()->all();
        return $this->render('index',[
            'modelInfo' => $modelInfo
        ]);
    }

    public function actionInfo(){

    }

    public function actionEdit(){

    }
}