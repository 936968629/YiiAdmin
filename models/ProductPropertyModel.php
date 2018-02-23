<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_property}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $detail
 * @property integer $product_id
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class ProductPropertyModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_property}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['detail'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'detail' => 'Detail',
            'product_id' => 'Product ID',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
