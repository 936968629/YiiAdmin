<?php
namespace app\common\service;

class StaticService{
    public static function includeAppJsStatic($path,$depend){
        self::includeAppStatic("js",$path,$depend);
    }

    public static function includeAppCssStatic($path,$depend){
        self::includeAppStatic("css",$path,$depend);
    }

    public static function includeAppStatic($type,$path,$depend){
        //加入版本号
        $release_version = defined("RELEASE_VERSION")?RELEASE_VERSION:time();
        $path = $path."?ver=".$release_version;

        if($type=="css"){
            \Yii::$app->getView()->registerCssFile($path,['depends'=>$depend]);
        }
        else if($type=="js"){
            \Yii::$app->getView()->registerJsFile($path,['depends'=>$depend]);
        }
    }
}