<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "md_city".
 *
 * @property int $Id
 * @property int|null $StateId
 * @property string|null $StateName
 * @property int|null $DistrictId
 * @property string|null $DistrictName
 * @property int|null $CityId
 * @property int|null $Sub_District_Version
 * @property string|null $CityName
 * @property string|null $Sub_District_NameIn_Local
 * @property string|null $Census_2001_Code
 * @property string|null $Census_2011_Code
 * @property bool|null $IsActive
 * @property int|null $SourceId
 * @property int|null $CountryId
 * @property int|null $CityCode
 */
class MdCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'md_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['StateId', 'DistrictId', 'CityId', 'Sub_District_Version', 'SourceId', 'CountryId', 'CityCode'], 'integer'],
            [['IsActive'], 'boolean'],
            [['StateName', 'DistrictName', 'CityName', 'Sub_District_NameIn_Local', 'Census_2001_Code', 'Census_2011_Code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'StateId' => 'State ID',
            'StateName' => 'State Name',
            'DistrictId' => 'District ID',
            'DistrictName' => 'District Name',
            'CityId' => 'City ID',
            'Sub_District_Version' => 'Sub District Version',
            'CityName' => 'City Name',
            'Sub_District_NameIn_Local' => 'Sub District Name In Local',
            'Census_2001_Code' => 'Census 2001 Code',
            'Census_2011_Code' => 'Census 2011 Code',
            'IsActive' => 'Is Active',
            'SourceId' => 'Source ID',
            'CountryId' => 'Country ID',
            'CityCode' => 'City Code',
        ];
    }
}
