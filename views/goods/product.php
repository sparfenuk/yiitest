<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 09.01.2019
 * Time: 19:05
 */



/* @var $this \yii\web\View */

/* @var $content string */
use yii\grid\GridView;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\models\ProductPhoto;
use yii\data\ActiveDataProvider;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\Product;


$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;




//

//     var_dump();
     if(Yii::$app->user->identity->status==2)
     {
         echo '<p>awdawdaw22222222dawda</p>';
         //HTML::button("Update");

     }
$name=ProductPhoto::findByProductId($product->id);
     var_dump($name);
echo '<div class="product-details">
<img style="width: 500px" src="'. Yii::$app->params['basePath'] . '/images/'. HTML::encode($name->image_name).'">
<div class="product-name">
'. HTML::encode($product->name).'
</div>

<div class="product-price">
'. HTML::encode($product->price).'
</div>
<div class="product-details">
'. HTML::encode($product->description).'
</div>


</div>';

 ?>