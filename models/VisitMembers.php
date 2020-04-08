<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visit_members".
 *
 * @property int $id
 * @property int $request_id
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string $remarks
 * @property string $address
 * @property string $with_mobile
 * @property string $with_laptop
 * @property string $member_action
 * @property string $member_mobile
 * @property string $member_email
 * @property string $other_material
 */
class VisitMembers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visit_members';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'name', 'mobile', 'email', 'remarks', 'address', 'with_mobile', 'with_laptop', 'member_action', 'member_mobile', 'member_email', 'other_material'], 'required'],
            [['request_id'], 'integer'],
            [['remarks', 'address', 'with_mobile', 'with_laptop', 'member_action', 'member_mobile', 'member_email', 'other_material'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'remarks' => 'Remarks',
            'address' => 'Address',
            'with_mobile' => 'With Mobile',
            'with_laptop' => 'With Laptop',
            'member_action' => 'Member Action',
            'member_mobile' => 'Member Mobile',
            'member_email' => 'Member Email',
            'other_material' => 'Other Material',
        ];
    }
}
