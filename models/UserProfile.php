<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $fname
 * @property string $lname
 * @property string $mobile
 * @property string $email
 * @property string $personal_address
 * @property int $personal_country
 * @property int $personal_state
 * @property int $personal_district
 * @property int $personal_city
 * @property int $personal_pin
 * @property string $official_address
 * @property int $official_country
 * @property int $official_state
 * @property int $official_district
 * @property int $official_city
 * @property int $official_pin
 * @property string $id_type
 * @property string $id_number
 * @property string $id_file
 * @property string $personal_photo
 * @property string $date_modified
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'fname', 'lname', 'mobile', 'email', 'personal_address', 'personal_country',  'id_type', 'id_number', 'id_file', 'personal_photo', 'date_modified'], 'required'],
            [['user_id', 'personal_state', 'personal_district', 'personal_city', 'personal_pin', 'official_state', 'official_district', 'official_city', 'official_pin'], 'integer'],
            [['personal_address', 'official_address', 'personal_country', 'official_country'], 'string'],
            [['date_modified','official_address', 'official_country', 'official_state', 'official_district', 'official_city', 'official_pin','gender','dob', 'personal_state', 'personal_district', 'personal_city', 'personal_pin'], 'safe'],
            [['fname', 'lname', 'email', 'id_file', 'personal_photo'], 'string', 'max' => 255],
            [['mobile', 'id_number'], 'string', 'max' => 50],
            [['id_type'], 'string', 'max' => 10],
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
            'fname' => 'First name',
            'lname' => 'Last name',
            'mobile' => 'Mobile No.',
            'email' => 'E-mail ID',
            'personal_address' => 'Address',
            'personal_country' => 'Country',
            'personal_state' => 'State',
            'personal_district' => 'District',
            'personal_city' => 'City',
            'personal_pin' => 'PinCode',
            'official_address' => 'Address',
            'official_country' => 'Country',
            'official_state' => 'State',
            'official_district' => 'District',
            'official_city' => 'City',
            'official_pin' => 'PinCode',
            'id_type' => 'Type',
            'id_number' => 'Number',
            'gender' => 'Gender',
            'dob' => 'Date of Birth',
            'id_file' => 'Id File',
            'personal_photo' => 'Personal Photo',
            'date_modified' => 'Date Modified',
        ];
    }
}
