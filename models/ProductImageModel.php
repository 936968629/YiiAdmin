<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_image}}".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $img
 * @property integer $order
 * @property integer $status
 */
class ProductImageModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'order', 'status'], 'integer'],
            [['img'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'img' => 'Img',
            'order' => 'Order',
            'status' => 'Status',
        ];
    }
}
