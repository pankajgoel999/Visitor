<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weapons_detail".
 *
 * @property int $id
 * @property int $request_id
 * @property int $member_id
 * @property string $weapon_detail
 * @property string $weapon_license
 * @property string $weapon_lic_no
 * @property string $lic_valid_till
 */
class WeaponsDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weapons_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'member_id', 'weapon_detail', 'weapon_license', 'weapon_lic_no', 'lic_valid_till'], 'required'],
            [['request_id', 'member_id'], 'integer'],
            [['weapon_license'], 'string'],
            [['lic_valid_till'], 'safe'],
            [['weapon_detail', 'weapon_lic_no'], 'string', 'max' => 255],
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
            'member_id' => 'Member ID',
            'weapon_detail' => 'Weapon Detail',
            'weapon_license' => 'Weapon License',
            'weapon_lic_no' => 'Weapon Lic No',
            'lic_valid_till' => 'Lic Valid Till',
        ];
    }
}
