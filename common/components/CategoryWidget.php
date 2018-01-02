<?php
namespace app\common\components;

use app\models\AdminMenuModel;
use yii\base\Widget;


class CategoryWidget extends Widget
{

    public function run()
    {
        $adminMenu = AdminMenuModel::find()->where(['parent_id' => 0,'status'=>1])->orderBy('list')->asArray()->all();
        foreach ($adminMenu as &$item){
            $adminchildMenu = AdminMenuModel::find()->where(['parent_id'=>$item['id'],'status'=>1])->orderBy('list')->asArray()->all();
            if(!empty($adminchildMenu)){
                $item['child'] = $adminchildMenu;
            }
        }
        return $this->render('category',['model' => $adminMenu]);
    }
}