<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/6
 * Time: 16:07
 */

namespace app\modules\admin\controllers;


use app\models\ProductModel;
use app\models\ThemeModel;
use app\models\ThemeProductModel;
use app\modules\admin\controllers\common\BaseController;

class ThemeController extends BaseController
{
    public function actionIndex(){
        $datalist = ThemeModel::find()->asArray()->all();

        return $this->render('index',[
            'datalist' => $datalist,
        ]);
    }

    //修改
    public function actionEdit(){
        if(\Yii::$app->request->isPost){
            $id = $this->post('id','','intval');
            $name = $this->post('name','','op_t');
            $description = $this->post('description','','op_t');
            $info = ThemeModel::find()->where(['id'=>$id])->one();
            $info->name = $name;
            $info->description = $description;
            $ret = $info->save();
            if(!$ret){
                return $this->renderJson(0);
            }
            return $this->renderJson(1);
        }else{
            $id = $this->get('id','','op_t');
            $info = ThemeModel::find()
                    ->where(['id'=>$id])
                    ->asArray()
                    ->one();
            return $this->render('edit',[
                'info' => $info,
            ]);
        }
    }
    //制定商品
    public function actionThemepro(){
        $id = $this->get('id','','intval');
        $products = ProductModel::find()
            ->select('id,name')
            ->where(['status'=>1])
            ->asArray()
            ->all();
        if(\Yii::$app->request->isPost){
            $products = $this->post('products','','op_t');
            ThemeProductModel::deleteAll(['theme_id'=>$id]);
            if(!empty($products)){
                foreach ($products as $item) {
                    $themeProduct = new ThemeProductModel();
                    $themeProduct->theme_id = $id;
                    $themeProduct->product_id = $item;
                    $themeProduct->save();
                }
            }
            $this->redirect(\Yii::$app->request->referrer);
//            return $this->renderJson(1);
        }else{
            $info = ThemeProductModel::find()
                ->where(['theme_id'=>$id])
                ->asArray()
                ->all();

            return $this->render('themepro',[
                'productInfo' => $products,
                'existArr' => array_column($info,'product_id')
            ]);
        }
    }

}