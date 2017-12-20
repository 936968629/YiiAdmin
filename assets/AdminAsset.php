<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AdminAsset extends AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public function registerAssetFiles($view)
    {
        $this->css = [
            'admin/css/bootstrap.min.css',
            'font-awesome/css/font-awesome.css',
            'admin/css/dermadefault.css',
            'admin/ss/templatecss.css',
            'admin/css/style.css'
        ];

        \Yii::$app->getView()->registerJsFile('/Admin/js/jquery-1.10.2.js',['position'=>View::POS_HEAD]);
        \Yii::$app->getView()->registerJsFile('/Admin/js/bootstrap.min.js',['position'=>View::POS_HEAD]);
        
        $this->js = [
            'Admin/js/global.js',
            'Admin/js/layer/layer.js'
        ];
        parent::registerAssetFiles($view); // TODO: Change the autogenerated stub
    }


}