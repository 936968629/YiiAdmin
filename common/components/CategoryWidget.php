<?php
namespace app\common\components;

use app\models\AdminMenu;
use yii\base\Widget;


class CategoryWidget extends Widget
{

    public function run()
    {
        $adminMenu = AdminMenu::find()->select();
        var_dump($adminMenu);
        return $this->render('category',['model' => $adminMenu]);
    }
}