<?php

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



$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;





     //var_dump($dataProvider);
echo '<div class="row">';
    foreach ($dataProvider->models as $goods) {
       echo '<div class="col-md-3 col-sm-6 col-xs-6">'.'<div class="product product-single">';

        $url = Url::toRoute(['goods/product', 'id' => $goods->id]);

       $name=ProductPhoto::findByProductId($goods->id);
        echo '<div class="product-thumb"><img style="width: 300px;" src="' . Yii::$app->params['basePath'] . '/images/'. HTML::encode($name->image_name).'" > </div>';

        echo '<div class="product-body">'

            .'<div class="name">'
              .'<a href='.$url.'>' .HTML::encode($goods->name) .'</a>'
            .'</div>'
              .'<div class="product-price">' . HTML::encode($goods->price)
              .'</div>'
            .'</div>';


        echo '</div>'.Html::a('label', ['/product/view?id='.$goods->id.''], ['class'=>'btn btn-primary']).'</div>';
    }
echo '</div>';

 ?>




