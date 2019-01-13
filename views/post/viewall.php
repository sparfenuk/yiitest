<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
//echo '<pre>';
//
//echo '</pre>';
?>
<div class="posts-index">

    <h1><?= Html::encode('<p>Text</p>') ?></h1>

    <p>

        <?php
        if (Yii::$app->user->isGuest === false)
            echo Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="single-post">
        <?php
        //        var_dump($product);
        //    echo '<pre>';

        foreach ($dataProvider->models as $post) {
            echo '<div class="row">';
            echo '<hr>';
                print_r($post->getUsers()->asArray()->all());
                var_dump($post->users[0]->username);
            echo '<hr>';
            if ($post->image_id === 0) {
                echo '<div class="image col-md-3"><img src="' . Yii::$app->params['basePath'] . '/images/No_image_3x4.svg.png" > </div>';
            }

            echo '<div class="col-md-9">' .
                '<div class="title">' . HTML::encode($post->title) . '</div>';
            echo '<div class="date-created">' . HTML::encode($post->date_created) . '</div>';
            echo '<div class="body">' . HTML::encode($post->body) . '</div>';
            echo '</div>';
            echo '</div>';
        }
        //    echo '</pre>';
        ?>
    </div>
    <!--    --><? //= GridView::widget([
    //        'dataProvider' => $dataProvider,
    //        'columns' => [
    //            ['class' => 'yii\grid\SerialColumn'],
    //
    //            'id',
    //            'title:ntext',
    //            'body:ntext',
    //            'image_id',
    //            'date_created',
    //
    //            ['class' => 'yii\grid\ActionColumn'],
    //        ],
    //    ]); ?>
</div>
