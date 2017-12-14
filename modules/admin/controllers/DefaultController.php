<?php

namespace app\modules\admin\controllers;

use app\models\AdminModel;
use app\modules\admin\controllers\common\BaseController;
use yii\captcha\Captcha;
use yii\captcha\CaptchaValidator;

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
        return $this->render('login');
    }
    /*
     * 处理登陆
     */
    public function actionLoginAct(){
        if(\Yii::$app->request->isPost){
            $login_name = trim($this->post('login_name','','op_t'));
            $login_pwd = trim($this->post('login_pwd','','op_t'));
            $capcha = trim($this->post('captcha','','op_t'));
            if(empty($login_name) || empty($login_pwd) || empty($capcha)){
                return $this->renderJson(3000);
            }else{
                $capchar = new CaptchaValidator();
                if( !$capchar->validate($capcha) ){
                    return $this->renderJson(3001);
                }
                $admin = new AdminModel();
                $dataTip = $admin->do_login($login_name,$login_pwd);
                if(!empty($dataTip)){
                    $data['msg'] = $dataTip;
                    return $this->renderJson($data);
                }else{

                }
            }
        }
    }
}
