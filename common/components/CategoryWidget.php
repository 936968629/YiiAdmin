<?php
namespace app\common\components;

use app\models\AdminMenu;
use yii\base\Widget;


class CategoryWidget extends Widget
{

    public function run()
    {
        $adminMenu = AdminMenu::find()->where(['parent_id' => 0])->orderBy('list')->all();

        return $this->render('category',['model' => $adminMenu]);
    }
}