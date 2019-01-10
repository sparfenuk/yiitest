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

    foreach ($dataProvider->models as $goods) {
       echo '<div class="row">';

        $url = Url::toRoute(['goods/productPage', 'id' => $goods->id]);

       $name=ProductPhoto::findByProductId($goods->id);
        echo '<div class="image col-md-3"><img style="max-width: 50%" src="' . Yii::$app->params['basePath'] . '/images/'.$name->image_name.'" > </div>';

        echo '<div class="col-md-9">' . '<div class="name">'. '<a href='.$url.'>' .HTML::encode($goods->name) .'</a>'.'</div>'. '</div>';

        echo '<div class="col-md-9">' . '<div class="price">' . HTML::encode($goods->price) . '</div>'.'</div>';

        echo '</div>';
    }
       echo '</pre>';

 ?>




