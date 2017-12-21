<?php
namespace app\common\components;

use app\models\AdminMenu;
use yii\base\Widget;


class CategoryWidget extends Widget
{

    public function run()
    {
        $adminMenu = AdminMenu::find()->where(['parent_id' => 0,'status'=>1])->orderBy('list')->asArray()->all();
        foreach ($adminMenu as &$item){
            $adminchildMenu = AdminMenu::find()->where(['parent_id'=>$item['id'],'status'=>1])->orderBy('list')->asArray()->all();
            if(!empty($adminchildMenu)){
                $item['child'] = $adminchildMenu;
            }
        }
        return $this->render('category',['model' => $adminMenu]);
    }
}