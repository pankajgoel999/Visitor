<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_master".
 *
 * @property int $id
 * @property string $type
 * @property string $is_active
 * @property string $date_modified
 */
class IdMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'is_active', 'date_modified'], 'required'],
            [['is_active'], 'string'],
            [['date_modified'], 'safe'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'is_active' => 'Is Active',
            'date_modified' => 'Date Modified',
        ];
    }
}
