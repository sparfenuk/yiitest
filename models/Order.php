<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property string $color
 * @property string $status
 */
class Order extends \yii\db\ActiveRecord
{
    CONST CREATED = 'CREATED';
    CONST PAYED = 'PAYED';
    CONST PROCESSED = 'PROCESSED';
    CONST SEND = 'SEND';
    CONST ARRIVED = 'ARRIVED';
    CONST FINISHED = 'FINISHED';
    CONST DISPUTED = 'DISPUTED';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id', 'quantity'], 'integer'],
            [['color', 'status'], 'string', 'max' => 255],
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
            'quantity' => 'Quantity',
            'color' => 'Color',
            'status' => 'Status',
        ];
    }
}
