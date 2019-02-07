<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 *
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{

  private  static $array_categories=null;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

     public static function  categoryName($id)
     {
         $name = self::find()->where(['id'=>$id])->one();
         return $name->name;
     }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
public static function getCategories()
{
    return self::find()->all();
}
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public static function getCategoryId($name)
    {
        $id = self::find()->where(['name'=>$name])->one();
        return $id->id;

    }


    public static function getSubCategoriesId($categories)
    {

        foreach ($categories as $category) {
            $sub = self::find()->where(['parent_id' => $category->id])->all();
            if($sub->count!=0)
            {
                self::getSubCategoriesId($sub);
            }
            else
            {
                array_push($array_categories,$category->id);

            }
        }
    }

}
