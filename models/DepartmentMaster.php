<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department_master".
 *
 * @property int $id
 * @property string $dept_name
 * @property string $dept_address
 * @property string $dept_email
 * @property string $dept_mobile
 * @property string $nodal_officer
 * @property string $is_active
 * @property string $date_modified
 */
class DepartmentMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dept_name', 'dept_address', 'dept_email', 'dept_mobile', 'nodal_officer', 'is_active', 'date_modified'], 'required'],
            [['is_active'], 'string'],
            [['date_modified'], 'safe'],
            [['dept_name', 'dept_address', 'dept_email', 'dept_mobile', 'nodal_officer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dept_name' => 'Dept Name',
            'dept_address' => 'Dept Address',
            'dept_email' => 'Dept Email',
            'dept_mobile' => 'Dept Mobile',
            'nodal_officer' => 'Nodal Officer',
            'is_active' => 'Is Active',
            'date_modified' => 'Date Modified',
        ];
    }
}
