<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emc_login_log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date_time
 *
 * @property User $user
 */
class LoginLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','action'], 'required'],
            [['user_id'], 'integer'],
            [['date_time'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
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
            'date_time' => 'Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
