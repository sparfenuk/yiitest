<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_photo".
 *
 * @property int $id
 * @property string $image_name
 * @property int $product_id
 *
 * @property Product $product
 */
class ProductPhoto extends \yii\db\ActiveRecord
{




    public static function findByProductId($productId)
    {
        $productPhoto = self::find()->where(['product_id' => $productId])->all();
        if ($productPhoto === null) return 'no_avatar.png';
        return $productPhoto;

    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_name', 'product_id'], 'required'],
            [['id', 'product_id'], 'integer'],
            [['image_name'], 'string', 'max' => 200],
            [['id'], 'unique'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_name' => 'Image Name',
            'product_id' => 'Product ID',
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
