<?php

namespace app\models\NP;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property int $id
 * @property int $SiteKey
 * @property string $Description
 * @property int $Phone
 * @property string $TypeOfWarehouse
 * @property string $Ref
 * @property string $CityRef
 * @property string $CityDescription
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SiteKey'], 'required'],
            [['SiteKey', 'Phone'], 'integer'],
            [['Description'], 'string', 'max' => 255],
            [['TypeOfWarehouse', 'Ref', 'CityRef'], 'string', 'max' => 32],
            [['CityDescription'], 'string', 'max' => 96],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'SiteKey' => 'Site Key',
            'Description' => 'Description',
            'Phone' => 'Phone',
            'TypeOfWarehouse' => 'Type Of Warehouse',
            'Ref' => 'Ref',
            'CityRef' => 'City Ref',
            'CityDescription' => 'City Description',
        ];
    }
}
