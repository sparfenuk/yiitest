<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auction_bit".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $amount
 */
class AuctionBit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auction_bit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'amount'], 'required'],
            [['user_id', 'product_id', 'amount'], 'integer'],
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
            'product_id' => 'Product ID',
            'amount' => 'Amount',
        ];
    }
}
