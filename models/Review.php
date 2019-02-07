<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $mark
 * @property string $description
 * @property string $created_at
 *
 * @property Product $product
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'mark'], 'required'],
            [['user_id', 'product_id', 'mark'], 'integer'],
            [['created_at'], 'safe'],
            [['description'], 'string', 'max' => 1000],
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
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'mark' => 'Mark',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getUser()
    {
     return User::find()->where(['id'=>$this->user_id])->one();
       // return $this->hasOne(User::className(), ['id' => 'user_id']);

    }
    public static function getAverageReview($id)
    {
      return self::find()->select('mark')->where(['product_id'=>$id])->average('mark');
    }

}
