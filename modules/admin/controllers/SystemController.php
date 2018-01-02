<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 14:19
 */

namespace app\modules\admin\controllers;


use app\modules\admin\controllers\common\BaseController;

class SystemController extends BaseController
{
    /*菜单管理*/
    public function actionMenu(){



        $this->render('menu',[]);
    }


}