<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/6
 * Time: 16:07
 */

namespace app\modules\admin\controllers;


use app\modules\admin\controllers\common\BaseController;

class ThemeController extends BaseController
{
    public function actionIndex(){

        return $this->render('index',[

        ]);
    }
}