<?php
namespace app\modules\admin\controllers;

use app\modules\admin\controllers\common\BaseController;

class IndexController extends BaseController {

    public function actionIndex(){
        $this->layout = "main";


        return $this->render('index');
    }

    public function actionGge(){

    }
	
	public function actionTest(){
	
	}
}