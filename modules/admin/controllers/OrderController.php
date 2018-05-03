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
use yii\data\Pagination;

class OrderController extends BaseController
{

    public function actionIndex(){
        $keyword = $this->get('keyword','','op_t');
        if(!empty($keyword) ){

        }

        $pagination = new Pagination([
            'totalCount'=>OrderModel::find()->count()
        ]);

        $datalist = OrderModel::find()
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('create_time desc')
            ->all();

        return $this->render('index',[
            'datalist' => $datalist,
            'pages' => $pagination,
            'keyword' => $keyword
        ]);
    }


}