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
            [['user_type', 'reg_ip', 'status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['password', 'email'], 'string', 'max' => 63],
            [['username'], 'string', 'max' => 16,'tooLong' => '用户名长度不合法'],
            [['mobile'], 'string', 'max' => 11],
//            [['username'], 'unique','message' => '用户名已存在'],
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
            'mobile' => 'Mobile',
            'reg_ip' => 'Reg Ip',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
        ];
    }

    //管理员登录
    public function do_login($username,$password){
//        $this->load(['AdminModel' => ['username'=>$username,'password'=>$password] ]);
        $this->attributes = ['username'=>$username,'password'=>$password];
        if($this->validate()){
            $userInfo = self::find()->where(['username' => $username])->one();
            if(!empty($userInfo)){
                $password = $this->encryptPassword($password,$userInfo['salt']);
                if($userInfo['password'] == $password){
                    //登陆成功
                    $_SESSION['admin'] = $userInfo['id'];
                    $userInfo->last_login_ip  = \app\common\tools\MyTools::get_client_ip();
                    $userInfo->last_login_time = NOW_TIME;
                    $userInfo->update_time = NOW_TIME;
                    $userInfo->save(0);
                    return "";
                }else{
                    $returnData = "密码错误";
                }
            }else{
                $returnData = "用户名不存在";
            }
            return $returnData;
        }else{
            //{username:"msg"}
            return current($this->getFirstErrors());
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
