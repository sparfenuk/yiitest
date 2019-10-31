<?php

namespace app\models;

use Yii;
use app\models\ProductPhoto;

/**
 * This is the model class for table "product_auction".
 *
 * @property int $id
 */
class ProductAuction extends \yii\db\ActiveRecord
{
   public $images = null;
   public $category_name = null;
    public function __construct()
    {
        $this->category_name = Category::categoryName($this->category_id);
        $this->images = ProductPhoto::findByProductId($this->id);
        if ($this->current_price == 0)
        {
            $this->current_price = $this->start_price;
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_auction';
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
