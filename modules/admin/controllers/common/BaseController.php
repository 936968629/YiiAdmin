<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/2 0002
 * Time: 8:57
 */

namespace app\modules\admin\controllers\common;


use app\common\components\BasePublicController;

class BaseController extends BasePublicController
{

    public function beforeAction($action)
    {
        $this->layout = false;
        
        return true;
     //   return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
}