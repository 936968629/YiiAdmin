<?php
namespace app\modules\admin\controllers;

use app\models\BannerItemModel;
use app\modules\admin\controllers\common\BaseController;

class BannerController extends BaseController {

    public function actionIndex(){
        $datalist = BannerItemModel::find()
            ->asArray()
            ->all();
        return $this->render('index',[
            'datalist'=>$datalist
        ]);
    }

}