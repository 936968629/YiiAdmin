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
            ->asArray()
            ->one();

        return json_encode($info);
//        return $this->render('info',[
//            'info' => $info
//        ]);
    }
    //反馈列表
    public function actionFeedback(){
        if(\Yii::$app->request->isPost){
            $id = $this->get('id',0,'intval');
            $content = $this->post('content','','op_t');
            $uid = $this->post('uid',0,'intval');

            $info = MessageModel::find()->where(['id'=>$id])->one();
            if( empty($info) ){
                return json_encode( array('code'=>0) );
            }
            $info->status = 1;
            $info->update_time = date('Y-m-d H:i:s');
            $info->save(0);

            $messageModel = new MessageModel();
            $messageModel->user_id = $uid;
            $messageModel->title = "反馈回复";
            $messageModel->content = $content;
            $messageModel->create_time = date('Y-m-d H:i:s');
            $messageModel->status = 0;
            $messageModel->resource_id = $id;
            $messageModel->save(0);
            return json_encode( array('code'=>1) );exit();
        }else{
            $keyword = $this->get('keyword','','op_t');
            $where = array();
            if( !empty($keyword) ){
                $where['user_id'] = intval($keyword);
            }
            $where['title'] = "问题反馈";
            $pagination = new Pagination([
                'totalCount' => MessageModel::find()->where($where)->count(),
            ]);

            $datalist = MessageModel::find()
                ->where($where)
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy('create_time desc')
                ->asArray()
                ->all();

            foreach ($datalist as &$item) {
                if($item['status'] == 0){
                    $item['reply'] = '<textarea rows="3" cols="25"></textarea>';
                }else{
                    $info = MessageModel::find()
                        ->where(['resource_id'=>$item['id'],'title'=>'反馈回复' ])
                        ->one();
                    $item['reply'] = $info['content'];
                }
            }

            return $this->render('feedback',[
                'datalist' => $datalist,
                'keyword' => $keyword,
                'pages' => $pagination
            ]);
        }


    }

}