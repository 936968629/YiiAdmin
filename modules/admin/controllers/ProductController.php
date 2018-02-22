<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/6
 * Time: 14:58
 */

namespace app\modules\admin\controllers;


use app\common\tools\ApiTools;
use app\models\CategoryModel;
use app\models\ProductImageModel;
use app\models\ProductModel;
use app\modules\admin\controllers\common\BaseController;

class ProductController extends BaseController
{
    public function actionIndex(){
        $datalist = ProductModel::find()
            ->select('bs_product.*,c.name c_name')
            ->join('inner join','bs_category c','bs_product.category_id = c.id')
            ->asArray()
            ->all();
        return $this->render('index',[
            'datalist' => $datalist
        ]);
    }

    public function actionEdit(){
        if(\Yii::$app->request->isPost){
            $id = $this->post('id','','intval');
            $name = $this->post('name','','op_t');
            $category = $this->post('category','','intval');
            $price = $this->post('price','0','floatval');
            $stock = $this->post('stock','0','intval');
            $info = ProductModel::find()->where(['id'=>$id])->one();
            $info->name = $name;
            $info->category_id = $category;
            $info->price = $price;
            $info->stock = $stock;
            $ret = $info->save();
            if(!$ret){
                return $this->renderJson(0);
            }
            return $this->renderJson(1);
        }else{
            $id = $this->get('id','','op_t');
            $info = ProductModel::find()
                ->select('bs_product.*,c.name c_name,c.id c_id')
                ->join('inner join','bs_category c','bs_product.category_id = c.id')
                ->where(['bs_product.id'=>$id])
                ->asArray()
                ->one();
            $categoryInfo = CategoryModel::find()->where(['status'=>1])->asArray()->all();

            return $this->render('edit',[
                'info' => $info,
                'categoryInfo' => $categoryInfo
            ]);
        }
    }

    public function actionAdd(){
        if(\Yii::$app->request->isPost){
            $name = $this->post('name','','op_t');
            $price = $this->post('price','0','floatval');
            $stock = $this->post('stock',0,'intval');
            $category = $this->post('category','','intval');
            $img = $this->post('img','','op_t');
            if(empty($img) || empty($name)){
                return $this->renderJson(3000);
            }
            $product = new ProductModel();
            $product->name = $name;
            $product->price = $price;
            $product->stock = $stock;
            $product->category_id = $category;
            $product->main_img_url = $img;
            $ret = $product->save();
            if(!$ret){
                return $this->renderJson(0);
            }
            return $this->renderJson(1);
        }else{
            $category = CategoryModel::find()
                ->where(['status'=>1])
                ->asArray()
                ->all();
            $categoryInfo = CategoryModel::find()->where(['status'=>1])->asArray()->all();

            return $this->render('add',[
                'category' => $category,
                'categoryInfo' => $categoryInfo
            ]);
        }
    }

    public function actionInfoimg(){
        if(\Yii::$app->request->isPost){

        }else{
            $id = $this->get('id','','op_t');
            $info = ProductImageModel::find()
                ->where(['product_id'=>$id])
                ->orderBy('order')
                ->asArray()
                ->all();

            return $this->render('infoimg',[
                'imgInfo' => $info,
                'product_id' => $id,
            ]);
        }

    }

    //修改状态
    public function actionEdit_status(){
        $id = $this->get('id','','intval');
        $status = $this->get('status','1','intval');
        if(empty($id)){
            return $this->renderJson(995);
        }else{
            $model = ProductModel::find();
            if( ApiTools::editStatus($model,$status,['id'=>$id]) ){
                return $this->renderJson(1);
            }else{
                return $this->renderJson(994);
            }
        }
    }
}