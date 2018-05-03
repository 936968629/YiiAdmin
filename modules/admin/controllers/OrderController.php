<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 14:34
 */

namespace app\modules\admin\controllers;

use app\models\OrderModel;
use app\modules\admin\controllers\common\BaseController;

class OrderController extends BaseController
{

    public function actionIndex(){



        return $this->render('index');
    }


}