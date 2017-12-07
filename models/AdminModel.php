<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property string $id
 * @property string $pid
 * @property integer $user_type
 * @property string $nickname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $email_bind
 * @property string $mobile
 * @property integer $mobile_bind
 * @property string $avatar
 * @property string $reg_ip
 * @property string $reg_type
 * @property string $create_time
 * @property string $update_time
 * @property integer $status
 */
class AdminModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type', 'email_bind', 'mobile_bind', 'reg_ip', 'status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['nickname', 'password', 'email'], 'string', 'max' => 63],
            [['username'], 'string', 'max' => 31],
            [['mobile'], 'string', 'max' => 11],
            [['avatar'], 'string', 'max' => 255],
            [['reg_type'], 'string', 'max' => 15],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_type' => 'User Type',
            'nickname' => 'Nickname',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'email_bind' => 'Email Bind',
            'mobile' => 'Mobile',
            'mobile_bind' => 'Mobile Bind',
            'avatar' => 'Avatar',
            'reg_ip' => 'Reg Ip',
            'reg_type' => 'Reg Type',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
        ];
    }


    public function do_login($username,$password){
//        $this->load(['AdminModel' => ['username'=>$username,'password'=>$password] ]);
        $this->attributes = ['username'=>$username,'password'=>$password];
        $returnData = [];
        if($this->validate()){
            $userInfo = self::find()->where(['username' => $username])->one();
            if(!empty($userInfo)){
                $password = $this->encryptPassword($password,$userInfo['salt']);
                if($userInfo['password'] == $password){

                }else{

                }
            }else{
                $returnData['msg']
            }
            return $returnData;
        }else{
//            return $this->getErrors();
            return $this->getFirstErrors();
        }
    }

    /**
     * 密码加密方式
     * @param $password
     * @param string $salt
     * @return string 加密密码
     * @author wjl
     */
    private function encryptPassword($password,$salt=''){
        return md5($salt.$password);
    }
}
