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
use yii\widgets\ActiveForm;

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;




//

$name=ProductPhoto::findByProductId($product->id);
     var_dump($name);
echo '<div class="product-details">

<img style="width: 500px" src="'. Yii::$app->params['basePath'] . '/images/'. HTML::encode($name).'">

<div class="product-name">
'. HTML::encode($product->name).'
</div>

<h3 class="product-price">
'. HTML::encode($product->price).'
</h3>

<div class="product-details">
'. HTML::encode($product->description).'
</div>';



if(is_array($product->colors)) {
//    foreach (explod(';', $product->colors) as $color) {

   $arr= $product->colors;
   var_dump( $arr );


   $form = ActiveForm::begin();

//     $form->field($product, 'color')->radioList($arr)->label(false);


    echo $form->field($product, 'colors')->radioList($arr)->label('Work Part Time');


    ActiveForm::end();


}
else if($product->colors!==null)
{


}

echo '</div>';

 ?>