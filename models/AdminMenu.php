<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%admin_menu}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $url
 * @property integer $list
 * @property integer $status
 */
class AdminMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'list'], 'required'],
            [['parent_id', 'list', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'url' => 'Url',
            'list' => 'List',
            'status' => 'Status',
        ];
    }
}
