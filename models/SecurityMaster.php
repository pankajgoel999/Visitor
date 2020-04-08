<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "security_master".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $designation
 * @property string $force_from
 * @property string $emp_id
 * @property string $mobile
 */
class SecurityMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'security_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'designation', 'force_from', 'emp_id', 'mobile'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'designation', 'force_from', 'emp_id', 'mobile'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'designation' => 'Designation',
            'force_from' => 'Force From',
            'emp_id' => 'Emp ID',
            'mobile' => 'Mobile',
        ];
    }
}
