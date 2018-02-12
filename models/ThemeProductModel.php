<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%theme_product}}".
 *
 * @property integer $theme_id
 * @property integer $product_id
 */
class ThemeProductModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%theme_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theme_id', 'product_id'], 'required'],
            [['theme_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theme_id' => 'Theme ID',
            'product_id' => 'Product ID',
        ];
    }
}
