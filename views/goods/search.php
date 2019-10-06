<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 12.02.2019
 * Time: 16:37
 */

use yii\helpers\Html;
use app\models\ProductPhoto;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = 'Search';
$this->params['breadcrumbs'][0] = ['label' => $this->title, 'link' => Yii::$app->request->url];

?>
<div class="col-md-12">
    <div class="section-title">
        <h2 class="title">Results for "<?= $search_param ?>"</h2>
        <div class="pull-right">
            <h3 class="title"> Order by: </h3>

            <ul class="order-by" >
                <li>  <?= $sort->link('name') ?>  </li>
                <li>  <?= $sort->link('price') ?>   </li>

            </ul>


        </div>
    </div>
</div>




<div class="container">
    <div class="row">
        <?php
        foreach ($dataProvider->models as $goods) {
            $url = Url::toRoute(['goods/product', 'id' => $goods->id]);
            $name = ProductPhoto::find()->where(['product_id' => $goods->id])->one();;
            ?>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="product product-single">
                    <div class="product-thumb">
                        <div class="product-label">
                            <?php
                            $d = $goods->getDiscount();
                            if ($d !== null) {
                                echo '<span class="sale">-' . $d . '%</span>';
                            } else if ($goods->isNew()) {
                                echo '	<span>New</span>';
                            }
                            ?>

                        </div>

                        <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                        <div style="width: 300px; height: 500px;">
                            <img style="width: 100%; height: 100%; object-fit: contain;"
                                 src="<?= '/images/product_images/' . HTML::encode($name->image_name) ?>">
                        </div>

                    </div>

                    <div class="product-body">

                        <h3 class="product-price"> <?= round($goods->price) ?>
                            <?php

                            if ($goods->prev_price != 0) {
                                echo '<del class="product-old-price">' . round($goods->prev_price) . '</del>';

                            }


                            ?>

                        </h3>

                        <div class="product-rating">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $goods->getAverageMark()) {
                                    echo '<i class="fa fa-star"></i>';
                                } else
                                    echo '<i class="fa fa-star-o empty"></i>';

                            }
                            ?>


                        </div>

                        <h2 class="product-name">
                            <a href="<?= $url ?>"><?= $goods->name ?></a>
                        </h2>
                        <div class="product-btns">
                            <?= Html::a('<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>', ['/site/add-to-favourites?id=' . $goods->id]); ?>
                            <?= Html::a('<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Cart</button>', ['/site/add-to-cart', 'productId' => $goods->id]); ?>

                        </div>
                        <?php


                        if ($goods->availability <= 0) {
                            echo 'Out of stock';

                        } else if (Yii::$app->user->identity && Yii::$app->user->identity->status >= 2) {
                            echo '<form method="get" action="/goods/update">
                       <input type="hidden" name="id" value="' . $goods->id . '">
                        <button type="submit">Update</button>
                       </form>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="col-md-12">
            <?= LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
        </div>
    </div>
</div>

