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
    public $products = array();
    public $i = 0; //for array counting (count() not works)
    public $sum = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    public function setProducts(){
        $carts = Cart::findAll(['user_id'=>Yii::$app->user->identity->id]);

//        $productIds = array();
       //return $carts;

        foreach ($carts as $cart){
//            array_push($this->products,Product::findProductById($cart['product_id']));
          $this->products[$this->i] = Product::findProductById($cart['product_id']);

          if($this->products[$this->i]) {
              $this->products[$this->i]->cartId = $cart['id'];
              $this->products[$this->i]->cartColor = $cart['color'];
              $this->products[$this->i]->cartQuantity = $cart['quantity'];
              $this->sum += $this->products[$this->i]['price'];
              $this->i++;
          }
        }

        return $this->products;
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

    public static function primaryKey()
    {
        return ['id'];
    }

}
