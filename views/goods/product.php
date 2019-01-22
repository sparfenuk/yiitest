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
    // var_dump($name);

echo '<div class="product-details">

<div class="product-name" style="font-size: 20pt ;">
'. HTML::encode($product->name).'
</div>
<br>
<br>
<img style="width: 500px" src="'. Yii::$app->params['basePath'] . '/images/product_images/'. HTML::encode($name).'">

<h3 class="product-price">
'. HTML::encode($product->price).'
</h3>

<div class="product-details">

'. HTML::encode($product->description).'

<br>
<br>
<br>
<br>
</div>';



if(is_array($product->colors)) {
//    foreach (explod(';', $product->colors) as $color) {

   $arr= $product->colors;


    if ($product->availability >= 0) {

        $form = ActiveForm::begin(['action' => ['goods/add-to-card'], 'options' => ['method' => 'post']]);


        echo $form->field($product, 'colors')->radioList($arr)->label('Color');


        echo Html::hiddenInput('id', $product->id);


        echo '<div class="form-group">' .
            Html::submitButton('Save', ['class' => 'btn btn-success'])
            . '</div>';
        ActiveForm::end();

    }
    else
    {
        echo 'Out of stock';

    }
}


echo '</div>';

 ?>