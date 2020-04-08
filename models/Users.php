<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $user_id
 * @property string $username
 * @property string|null $password
 * @property int $Role_Id
 * @property string|null $PasswdVerificationCode
 * @property string|null $PasswdVerificationCodeDate
 * @property string|null $PasswdVerificationCodeTime
 * @property int|null $OTPCode
 * @property string|null $OTPDate
 * @property string|null $OTPTime
 * @property string|null $date_modified
 * @property string|null $is_active
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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
}
