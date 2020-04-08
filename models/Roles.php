<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property int $role_id
 * @property string $role_name
 * @property string $is_active
 * @property string $date_modi
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_name', 'is_active', 'date_modi'], 'required'],
            [['is_active'], 'string'],
            [['date_modi'], 'safe'],
            [['role_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'role_name' => 'Role Name',
            'is_active' => 'Is Active',
            'date_modi' => 'Date Modi',
        ];
    }
}
