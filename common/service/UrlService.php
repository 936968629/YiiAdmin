<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/2 0002
 * Time: 9:07
 */
namespace app\common\service;

use yii\helpers\Url;

class UrlService
{
    /*
     *admin模块
     */
    public static function buildAdminUrl($path,$params=[]){
        $path = Url::toRoute(array_merge([$path],$params));
        return '/admin'.$path;
    }
    /*
     * web模块
     */
    public static function buildWebUrl($path,$params=[]){

    }

    /*
     *根目录
     */
    public static function buildWwwUrl($path,$params=[]){
        return Url::toRoute(array_merge([$path],$params));
    }

    /**
     * 当前url
     * @author wjl
     */
    public static function buildCurrentUrl(){
        return \Yii::$app->request->getUrl();
    }

}