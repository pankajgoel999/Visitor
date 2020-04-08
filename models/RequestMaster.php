<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_master".
 *
 * @property int $id
 * @property int $user_id
 * @property string $purpose
 * @property int $dept
 * @property string $visit_date
 * @property string $visit_time
 * @property string $remarks
 * @property string $status
 * @property string $dept_remarks
 * @property string $date_modified
 */
class RequestMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'purpose', 'dept', 'visit_date', 'visit_time', 'remarks', 'status', 'dept_remarks', 'date_modified'], 'required'],
            [['id', 'user_id', 'dept'], 'integer'],
            [['purpose', 'remarks', 'status', 'dept_remarks'], 'string'],
            [['visit_date', 'visit_time', 'date_modified'], 'safe'],
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
            'purpose' => 'Purpose',
            'dept' => 'Dept',
            'visit_date' => 'Visit Date',
            'visit_time' => 'Visit Time',
            'remarks' => 'Remarks',
            'status' => 'Status',
            'dept_remarks' => 'Dept Remarks',
            'date_modified' => 'Date Modified',
        ];
    }
}
