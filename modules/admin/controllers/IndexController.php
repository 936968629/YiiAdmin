<?php
namespace app\modules\admin\controllers;

use app\modules\admin\controllers\common\BaseController;

class IndexController extends BaseController {

//    public function beforeAction($action)
//    {
//        echo "1";
//        return parent::beforeAction($action); // TODO: Change the autogenerated stub
//    }

    public function actionIndex(){
        $this->layout = "main";
        var_dump("das");
        return $this->render('index');
    }

    public function actionGge(){

    }
}