<?php

namespace app\models\NP;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $Ref
 * @property double $Latitude
 * @property double $Longitude
 * @property string $Description
 * @property string $SettlementTypeDescription
 * @property string $Region
 * @property string $RegionsDescription
 * @property string $Area
 * @property string $AreaDescription
 * @property int $Index
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Ref', 'Latitude', 'Longitude'], 'required'],
            [['Latitude', 'Longitude'], 'number'],
            [['Index'], 'integer'],
            [['Ref', 'Region', 'Area'], 'string', 'max' => 48],
            [['Description'], 'string', 'max' => 96],
            [['SettlementTypeDescription'], 'string', 'max' => 16],
            [['RegionsDescription', 'AreaDescription'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Ref' => 'Ref',
            'Latitude' => 'Latitude',
            'Longitude' => 'Longitude',
            'Description' => 'Description',
            'SettlementTypeDescription' => 'Settlement Type Description',
            'Region' => 'Region',
            'RegionsDescription' => 'Regions Description',
            'Area' => 'Area',
            'AreaDescription' => 'Area Description',
            'Index' => 'Index',
        ];
    }
}
