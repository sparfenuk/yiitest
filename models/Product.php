<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $brand
 * @property string $price
 * @property int $availability
 * @property int $is_new
 * @property int $discount
 * @property string $description
 * @property int $reviews_count
 * @property string $colors
 * @property int $photos_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ProductPhoto[] $productPhotos
 * @property Review[] $reviews
 */
class Product extends \yii\db\ActiveRecord
{
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
            [['id', 'name', 'price', 'description'], 'required'],
            [['id', 'availability', 'is_new', 'discount', 'reviews_count'], 'integer'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 32],
            [['brand'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1000],
            [['colors'], 'string', 'max' => 200],
            [['id'], 'unique'],
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'brand' => 'Brand',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPhotos()
    {
        return $this->hasMany(ProductPhoto::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['product_id' => 'id']);
    }
}
