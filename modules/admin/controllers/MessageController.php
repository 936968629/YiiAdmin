<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/5 0005
 * Time: 22:50
 */
namespace app\modules\admin\controllers;

use app\models\MessageModel;
use app\modules\admin\controllers\common\BaseController;
use yii\data\Pagination;

class MessageController extends BaseController
{

    public function actionIndex(){

        $keyword = $this->get('keyword','','op_t');
        $where = array();
        if( !empty($keyword) ){
            $where['user_id'] = $keyword;
        }

        $pagination = new Pagination([
            'totalCount' => MessageModel::find()->where($where)->count(),
        ]);

        $datalist = MessageModel::find()
            ->where($where)
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('create_time desc')
            ->all();

        return $this->render('index',[
            'datalist' => $datalist,
            'keyword' => $keyword,
            'pages' => $pagination
        ]);
    }

    public function actionInfo(){
        $id = $this->get('id',0,'intval');
        $info = MessageModel::find()
            ->where(['id'=>$id])
            ->one();

        return $this->render('info',[
            'info' => $info
        ]);
    }

}