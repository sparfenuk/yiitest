<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_auction_photo".
 *
 * @property int $id
 */
class ProductAuctionPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_auction_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }
}
