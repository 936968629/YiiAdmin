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
        return $this->render('login',[
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x000000,//背景颜色
                'maxLength' => 6, //最大显示个数
                'minLength' => 2,//最少显示个数
                'padding' => 5,//间距
                'height' => 40,//高度
                'width' => 130,  //宽度
                'foreColor' => 0xffffff,     //字体颜色
                'offset' => 4,        //设置字符偏移量 有效果
            ],
        ]);
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
