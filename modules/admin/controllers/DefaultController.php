<?php

namespace app\modules\admin\controllers;

use app\modules\admin\controllers\common\BaseController;

/**
 * Default controller for the `Admin` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('admin/default/login');
//        return $this->render('index');

    }
    /*
     * 登陆界面
     */
    public function actionLogin(){
        $aa = $this->get('id','45','op_t');
        var_dump($aa);
        return $this->render('login');
    }
    /*
     * 处理登陆
     */
    public function actionLoginAct(){
        if(\Yii::$app->request->isPost){
            $login_name = trim($this->post('login_name',''));
            $login_pwd = trim($this->post('login_pwd',''));
            if(empty($login_name) || empty($login_pwd)){

            }
        }
    }
}
