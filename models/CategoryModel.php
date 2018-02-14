<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $topic_img
 * @property string $update_time
 * @property integer $status
 */
class CategoryModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['update_time'], 'safe'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['topic_img'], 'string', 'max' => 80],
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
            'topic_img' => 'Topic Img',
            'update_time' => 'Update Time',
            'status' => 'Status',
        ];
    }
}
