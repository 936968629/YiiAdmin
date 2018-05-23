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
use app\models\ProductPropertyModel;
use app\modules\admin\controllers\common\BaseController;

class ProductController extends BaseController
{
    public function actionIndex(){
        $datalist = ProductModel::find()
            ->select('bs_product.*,c.name c_name')
            ->join('inner join','bs_category c','bs_product.category_id = c.id')
            ->orderBy('id desc')
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
            $nh_pro = $this->post('nh_pro','','op_t');
            $info = ProductModel::find()->where(['id'=>$id])->one();
            $info->name = $name;
            $info->category_id = $category;
            $info->price = $price;
            $info->stock = $stock;
            if(!empty($nh_pro) ){
                if( in_array('new',$nh_pro) ){
                    $info->is_new = 1;
                }
                else
                    $info->is_new = 0;
                if( in_array('hot',$nh_pro) )
                    $info->is_hot = 1;
                else
                    $info->is_hot = 0;
            }else{
                $info->is_hot = 0;
                $info->is_new = 0;
            }
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
            $price = $this->post('price',0,'floatval');
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
            $product->create_time = date('Y-m-d H:i:s');
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
            $id = $this->post('id','','op_t');
            $order = $this->post('order',1,'intval');
            $type = $this->post('type','','op_t');
            if($type == "edit"){
                $info = ProductImageModel::find()
                    ->where(['id'=>$id])
                    ->one();
                $info->order = $order;
                $ret = $info->save(0);
            }else{//删除
                $info = ProductImageModel::find()
                    ->where(['id'=>$id])
                    ->one();
                if($type == 'remove'){
                    $info->status = 0;
                }else{
                    $info->status = 1;
                }
                $ret = $info->save(0);
            }
            if(!$ret){
                return $this->renderJson(0);
            }
            return $this->renderJson(1);
        }else{
            $id = $this->get('id','','op_t');
            $info = ProductImageModel::find()
                ->where(['product_id'=>$id ])
                ->orderBy('order')
                ->asArray()
                ->all();

            return $this->render('infoimg',[
                'imgInfo' => $info,
                'product_id' => $id,
            ]);
        }

    }
    //详细信息
    public function actionInfo(){
        if(\Yii::$app->request->isPost){
            $id = $this->post('id','','intval');
            $text = $this->post('ta','','op_t');
            $pro_id = $this->post('pro_id','','intval');
            if(empty($id) ){
                $productPropertyModel = new ProductPropertyModel();
                $productPropertyModel->detail = $text;
                $productPropertyModel->product_id = $pro_id;
                $productPropertyModel->save();
            }else{
                $info = ProductPropertyModel::find()
                    ->where(['id'=>$id])
                    ->one();
                $info->detail = $text;
                $info->save();
            }
            return $this->renderJson(1);
        }else{
            $id = $this->get('id','','op_t');
            $info = ProductPropertyModel::find()
                ->where(['id'=>$id])
                ->asArray()
                ->one();
            return $this->render('info',[
               'info' => $info,
                'id' => $id
            ]);
        }
    }

    //修改状态
    public function actionEdit_status(){
        $id = $this->get('id','','intval');
        $status = $this->get('status',1,'intval');
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