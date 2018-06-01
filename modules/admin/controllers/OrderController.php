<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 14:34
 */

namespace app\modules\admin\controllers;

use app\models\OrderModel;
use app\models\ProductModel;
use app\modules\admin\controllers\common\BaseController;
use yii\data\Pagination;

class OrderController extends BaseController
{

    public function actionIndex(){
        $keyword = $this->get('keyword','','op_t');
        $where = array();
        if(!empty($keyword) ){
            if( is_numeric($keyword) ){
                $where['user_id'] = $keyword;
            }else{
                $where['order_no'] = $keyword;
            }
        }
        $pagination = new Pagination([
            'totalCount'=>OrderModel::find()->count()
        ]);

        $datalist = OrderModel::find()
            ->where($where)
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('create_time desc')
            ->asArray()
            ->all();

        foreach ($datalist as &$item){
            $item['snap_items'] = json_decode($item['snap_items'],true);
            $item['productinfo'] = '';
            foreach ($item['snap_items'] as $val){
                $proInfo = ProductModel::find()->where(['id'=>$val['id'] ])->one();
                $item['productinfo'] .= "商品id:".$val['id']." 名称:".$proInfo['name'].'×'.$val['counts']." ";
            }
        }

        return $this->render('index',[
            'datalist' => $datalist,
            'pages' => $pagination,
            'keyword' => $keyword
        ]);
    }

    public function actionInfo(){
        $id = $this->get('id','','intval');
        $info = OrderModel::find()
            ->where(['id'=>$id])
//            ->orderBy('create_time desc')
            ->one();
        $addressArr = json_decode($info['snap_address'],true);
        $addressInfo = "姓名:".$addressArr['name']." 电话".$addressArr['mobile'];
        return $this->render('info',[
            'info' => $info,
            'addressInfo' => $addressInfo
        ]);
    }
    //发货
    public function actionWinner(){
        $keyword = $this->get('keyword','','op_t');
        $status = $this->get('status',0,'intval');
        $where = array();
        if(!empty($keyword) ){
            if( is_numeric($keyword) ){
                $where['user_id'] = $keyword;
            }else{
                $where['order_no'] = $keyword;
            }
        }
        if( is_int($status) && $status != 0){
            $where['status'] = $status;
        }else{
            $where = array('in','status',[2,3,4]);
        }
        $page = new Pagination([
            'totalCount' => OrderModel::find()->where($where)->count(),
        ]);
        $datalist = OrderModel::find()
            ->where($where)
            ->offset($page->offset)
            ->limit($page->limit)
            ->orderBy('create_time desc')
            ->asArray()
            ->all();

        foreach ($datalist as &$item){
            $item['snap_items'] = json_decode($item['snap_items'],true);
            $item['productinfo'] = '';
            foreach ($item['snap_items'] as $val){
                $proInfo = ProductModel::find()->where(['id'=>$val['id'] ])->one();
                $item['productinfo'] .= "商品id:".$val['id']." 名称:".$proInfo['name'].'×'.$val['counts']." ";
            }
            $item['snap_address'] = json_decode($item['snap_address'],true);
        }
//        var_dump($datalist);exit();
        return $this->render('winner',[
            'datalist' => $datalist,
            'pages' => $page,
            'keyword' => $keyword
        ]);
    }
    //发货处理
    public function actionSend(){
        if(\Yii::$app->request->isPost){
            $id = $this->post('id',0,'intval');
            $name = $this->post('name','','op_t');
            $number = $this->post('number','','op_t');
            $info = OrderModel::find()
                ->where(['id'=>$id])
                ->one();
            $info->kuaidi_name = $name;
            $info->kuaidi_order = $number;
            $info->status = 3;
            $ret = $info->save();
            if(!$ret){
                return $this->renderJson(0);
            }
            //消息通知
            $content = "你购买的商品【".$info['snap_name']."】已发货，请注意查收";
            $re = insertMsg($info['user_id'],'发货通知',$content);
            if(!$re){
                return $this->renderJson(0);
            }
            return $this->renderJson(1);
        }else{
            $id = $this->get('id',0,'intval');
            $info = OrderModel::find()
                ->where(['id'=>$id])
                ->one();

            return $this->render('send',[
                'info' => $info,
            ]);
        }


    }
}