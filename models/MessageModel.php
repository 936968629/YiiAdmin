<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 * @property string $create_time
 * @property string $update_time
 * @property integer $status
 */
class MessageModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'content'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
        ];
    }
}
