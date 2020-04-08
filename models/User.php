<?php

namespace app\models;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements  IdentityInterface
{
     public $authKey;
 
    public static function tableName(){
        return 'users';
    }

    public function rules()
    {
        return [
            [['username', 'Role_Id'], 'required'],
            [['Role_Id', 'OTPCode'], 'integer'],
            [['PasswdVerificationCodeDate', 'PasswdVerificationCodeTime', 'OTPDate', 'OTPTime', 'date_modified'], 'safe'],
            [['is_active'], 'string'],
            [['username', 'password'], 'string', 'max' => 255],
            [['PasswdVerificationCode'], 'string', 'max' => 1000],
        ];
    }
    
     public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'Role_Id' => 'Role ID',
            'PasswdVerificationCode' => 'Passwd Verification Code',
            'PasswdVerificationCodeDate' => 'Passwd Verification Code Date',
            'PasswdVerificationCodeTime' => 'Passwd Verification Code Time',
            'OTPCode' => 'Otp Code',
            'OTPDate' => 'Otp Date',
            'OTPTime' => 'Otp Time',
            'date_modified' => 'Date Modified',
            'is_active' => 'Is Active',
        ];
    }

   
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
     
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByemail($email)
    {
        //echo $email;die;
        return static::findOne(['username' => $email, 'is_active'=>'Y']);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public static function validatePassword($email, $password)
    {
        $chk = User::findOne(['username' => $email, 'is_active'=>'Y']);
        $password = md5($password);
        
        if($password == $chk->password){
			Yii::$app->Utility->initLogin($email);
            return true;
        }else{
            return false;
        }
        
    }
}
