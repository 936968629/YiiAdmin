<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/14
 * Time: 15:02
 */

namespace app\modules\admin\controllers;


use app\models\CategoryModel;
use app\modules\admin\controllers\common\BaseController;

class CategoryController extends BaseController
{
    public function actionIndex(){
        $info = CategoryModel::find()->asArray()->all();

        return $this->render('index',[
            'info' => $info
        ]);
    }

    public function actionEdit(){

    }

    public function actionAdd(){
        
    }

}