<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 *
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{



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
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'parent_id' => 'Parent ID',
        ];
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


    public static function getSub($id=null)
    {
        if ($id!==null)
        {
            $arr=array();
            $categories = self::find()->where(['id'=>$id])->all();
        Category::getSubCategoriesId($categories,$arr);
         return $arr;
        }
    }
    public static function getSubCategoriesId($categories,&$arr)
    {
        foreach ($categories as $category) {

            $sub = self::find()->where(['parent_id' => $category->id])->andWhere('parent_id != id')->all();

            if(!empty($sub))
            {
             self::getSubCategoriesId($sub,$arr);
            }
            else
            {
               array_push($arr,$category->id);
            }
        }
    }

    public static function categoryName($id)
    {
        $name = self::find()->where(['id'=>$id])->one();
        return isset($name->name)? $name->name : '';
    }

    public static function getSubCategories()
    {
        $categories = Category::find()->where('id != parent_id')->all();
        return $categories;
    }
}
