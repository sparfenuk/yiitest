<?php

/* @var $this \yii\web\View */

/* @var $content string */
use yii\grid\GridView;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;



$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;





     var_dump($dataProvider);
    foreach ($dataProvider->models as $goods) {
       echo '<div class="row">';

        //  if ($post->image_id === 0) {
        echo '<div class="image col-md-3"><img style="max-width: 50%" src="' . Yii::$app->params['basePath'] . '/images/No_image_3x4.svg.png" > </div>';
        // }

        echo '<div class="col-md-9">' . '<div class="name">'. '<a href="goodsPage.php">' .HTML::encode($goods->name) .'</a>'.'</div>'. '</div>';

        echo '<div class="col-md-9">' . '<div class="price">' . HTML::encode($goods->price) . '</div>'.'</div>';

        echo '</div>';
    }
       echo '</pre>';

 ?>




