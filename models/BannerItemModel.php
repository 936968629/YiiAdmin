<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%banner_item}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $banner_id
 * @property string $img
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class BannerItemModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'banner_id'], 'required'],
            [['type', 'banner_id', 'status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['img'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'banner_id' => 'Banner ID',
            'img' => 'Img',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
