<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $brand
 * @property int $category_id
 * @property string $price
 * @property int $availability
 * @property int $is_new
 * @property int $discount
 * @property string $description
 * @property int $reviews_count
 * @property string $colors
 * @property string $created_at
 * @property string $updated_at
 * @property int $cartId
 * @property Category $category
 * @property ProductPhoto[] $productPhotos
 * @property Review[] $reviews
 * @property string $cartColor
 * @property integer $cartQuantity
 */
class Product extends \yii\db\ActiveRecord
{
    public $cartId;
    public $cartColor = '';
    public $cartQuantity;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'price', 'description'], 'required'],
            [['category_id', 'availability', 'is_new', 'discount', 'reviews_count'], 'integer'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 32],
            [['brand'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1000],
            [['colors'], 'string', 'max' => 200],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'brand' => 'Brand',
            'category_id' => 'Category ID',
            'price' => 'Price',
            'availability' => 'Availability',
            'is_new' => 'Is New',
            'discount' => 'Discount',
            'description' => 'Description',
            'reviews_count' => 'Reviews Count',
            'colors' => 'Colors',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public  static  function findProductById($id)
    {
        $product=self::find()->where(['id'=>$id])->one();
        if ($product === null) return null;
        return new static($product);
    }
    public static function findProductByName($name)
    {
        $product=self::find()->where(['name'=>$name])->all();
        if ($product === null) return null;
        return new static($product);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPhotos()
    {
        return $this->hasMany(ProductPhoto::className(), ['product_id' => 'id']);
    }

    public function checkIfExist($product)
    {
        self::find()->where(['name'=>$product->name])->one();
         if(exists===true)
         {
             $product->update();

         }
         else
         {
             $product->save();

         }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['product_id' => 'id']);
    }
}
