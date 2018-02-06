<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 14:19
 */

namespace app\modules\admin\controllers;


use app\common\tools\ApiTools;
use app\common\tools\MyTools;
use app\models\AdminMenuModel;
use app\modules\admin\controllers\common\BaseController;

class SystemController extends BaseController
{
    /*菜单管理*/
    public function actionMenu(){
        $adminMenu = AdminMenuModel::find()->where(['parent_id' => 0])->orderBy('list')->asArray()->all();
        foreach ($adminMenu as &$item){
            $adminchildMenu = AdminMenuModel::find()->where(['parent_id'=>$item['id'] ])->orderBy('list')->asArray()->all();
            if(!empty($adminchildMenu)){
                $item['child'] = $adminchildMenu;
            }
        }
        return $this->render('menu',[
            'modelInfo' => $adminMenu
        ]);
    }
    //修改菜单信息
    public function actionMenu_edit(){
        if(\Yii::$app->request->isPost){
            $id = $this->post('id','','intval');
            $parent_id = $this->post('parent_id','','intval');
            $name = $this->post('name','','op_t');
            $url = $this->post('url','','op_t');
            $list = $this->post('list','','op_t');
            $info = AdminMenuModel::find()->where(['id'=>$id])->one();
            $info->parent_id = $parent_id;
            $info->name = $name;
            $info->url = $url;
            $info->list = $list;
            $info->save(0);
            return $this->renderJson(['url'=>'menu'],1);
        }else{
            $id = $this->get('id','','intval');
            $currentMenu = AdminMenuModel::find()->where(['id'=>$id])->asArray()->one();
            if(empty($id) || empty($currentMenu)){
                return $this->error('没有改数据');
            }
            //查找
            $parentMenu = AdminMenuModel::find()->where(['id'=>$currentMenu['parent_id']])->asArray()->one();
            if(empty($parentMenu)){
                //说明是顶级菜单
                $parentMenu['name'] = "顶级菜单";
                $parentMenu['parent_id'] = 0;
            }
            $data = AdminMenuModel::find()->asArray()->all();
            $selectDom = MyTools::getTreeMenuSelect($data);
            return $this->render('menuEdit',[
                'parentMenu' => $parentMenu,
                'selectDom' => $selectDom,
                'currentMenu' => $currentMenu
            ]);
        }
    }
    //添加菜单
    public function actionMenu_add(){
        if(\Yii::$app->request->isPost){
            $parent_id = $this->post('parent_id','','op_t');
            $name = $this->post('name','','op_t');
            $url = $this->post('url','','op_t');
            $list = $this->post('list','','intval');

            if( empty($name) || empty($url) || $list == ""){
                return $this->renderJson(3000);
//                return $this->renderJson(['id'=>$parent_id,'name'=>$name,'url'=>$url,'list'=>$list],800);
            }
            $info = new AdminMenuModel();
            $info->parent_id = $parent_id;
            $info->name = $name;
            $info->url = $url;
            $info->list = $list;
            $info->save(0);
            return $this->renderJson(['url'=>'menu'],1);
        }else{
            $data = AdminMenuModel::find()->asArray()->all();
            $selectDom = MyTools::getTreeMenuSelect($data);
            return $this->render('menuEdit',[
                'selectDom' => $selectDom,
                'type' => 'add',
            ]);
        }
    }

    //修改菜单状态
    public function actionEdit_status(){
        $id = $this->get('id','','intval');
        $status = $this->get('status','1','intval');
        if(empty($id)){
//            return $this->error("id参数错误");
            return $this->renderJson(995);
        }else{
            $model = AdminMenuModel::find();
            if( ApiTools::editStatus($model,$status,['id'=>$id]) ){
                return $this->renderJson(1);
//                $this->redirect(\Yii::$app->request->referrer);//返回上一页
            }else{
//                return $this->error('没有找到该数据');
                return $this->renderJson(994);
            }
        }
    }

}