<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 23.01.2019
 * Time: 17:50
 */

/* @var $this \yii\web\View */

/* @var $content string */


use yii\widgets\LinkPager;


$this->title = $category;
$this->params['breadcrumbs'][0] = ['label' => $category, 'link' => Yii::$app->request->url];

?>
<div class="col-md-12">
    <div class="section-title">
        <h2 class="title"><?= $category ?></h2>
        <div class="pull-right">
            <h3 class="title"> Order by: </h3>
            <ul class="order-by">
                <li>  <?= $sort->link('name') ?>  </li>
                <li>  <?= $sort->link('price') ?>   </li>

            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">

        <?php foreach ($dataProvider->models as $product) {
            echo $this->render('@app/views/base/single_product', [
                'product' => $product,
            ]);
        } ?>

        <div class="col-md-12">
            <?= LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
        </div>
    </div>
</div>

