<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property string $order_no
 * @property integer $user_id
 * @property string $total_price
 * @property integer $status
 * @property string $snap_img
 * @property string $snap_name
 * @property integer $total_count
 * @property string $snap_items
 * @property string $snap_address
 * @property string $prepay_id
 * @property string $create_time
 * @property string $update_time
 */
class OrderModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'total_price', 'snap_img', 'snap_name', 'total_count', 'snap_items', 'snap_address'], 'required'],
            [['user_id', 'status', 'total_count'], 'integer'],
            [['total_price'], 'number'],
            [['snap_items'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['order_no'], 'string', 'max' => 25],
            [['snap_img', 'snap_address'], 'string', 'max' => 255],
            [['snap_name'], 'string', 'max' => 80],
            [['prepay_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => 'Order No',
            'user_id' => 'User ID',
            'total_price' => 'Total Price',
            'status' => 'Status',
            'snap_img' => 'Snap Img',
            'snap_name' => 'Snap Name',
            'total_count' => 'Total Count',
            'snap_items' => 'Snap Items',
            'snap_address' => 'Snap Address',
            'prepay_id' => 'Prepay ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
