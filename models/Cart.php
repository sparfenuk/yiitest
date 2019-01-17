<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $user_id
 * @property int $product_id
 * @property string $color
 * @property int $quantity
 * @property Product[] $products
 * @property User $user
 */
class Cart extends \yii\db\ActiveRecord
{
    public $products;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    public static function setUsers(){
        $productIds = Cart::findAll(['user_id'=>Yii::$app->user->identity->id]);
        return $productIds;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id', 'quantity'], 'integer'],
            [['color'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'color' => 'Color',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('carts');
    }
}
