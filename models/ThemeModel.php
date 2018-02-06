<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%theme}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $head_img
 * @property string $img
 * @property string $create_time
 * @property string $update_time
 */
class ThemeModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%theme}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 200],
            [['head_img', 'img'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'head_img' => 'Head Img',
            'img' => 'Img',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }


}
