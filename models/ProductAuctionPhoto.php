<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_auction_photo".
 *
 * @property int $id
 * @property string $image_name
 * @property int $product_id
 *
 * @property Product $product
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
    public static function findByProductId($productId)
    {
        $productPhoto = self::find()->where(['product_id' => $productId])->all();
        if ($productPhoto === null) return 'no_avatar.png';
        return $productPhoto;

    }
}
