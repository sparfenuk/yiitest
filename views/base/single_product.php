<?php
use yii\helpers\Html;
use app\models\ProductPhoto;
use yii\helpers\Url;

    $url = Url::toRoute(['goods/product', 'id' => $product->id]);
    $name = ProductPhoto::find()->where(['product_id' => $product->id])->one();
?>
<div class="col-md-4 col-sm-6 col-xs-6">
                <div class="product product-single">
                    <div class="product-thumb">
                        <div class="product-label">
                            <?php
                            $d = $product->getDiscount();
                            if ($d !== null) {
                                echo '<span class="sale">-' . $d . '%</span>';
                            }
                            if ($product->isNew()) {
                                echo '	<span>New</span>';
                            }
                            ?>

                        </div>

                        <?= Html::a('<button class="main-btn quick-view"><i class="fa fa-search-plus"></i>View</button>', ['/goods/product?id=' . $product->id]) ?>
                        <div style="width: 300px; height: 500px;">
                            <img style="width: 100%; height: 100%; object-fit: contain;"
                                 src="<?= '/images/product_images/' . HTML::encode($name->image_name) ?>">
                        </div>

                    </div>

                    <div class="product-body">

                        <h3 class="product-price"> <?= round($product->price) ?>
                            <?php

                            if ($product->prev_price != 0) {
                                echo '<del class="product-old-price">' . round($product->prev_price) . '</del>';

                            }


                            ?>

                        </h3>

                        <div class="product-rating">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $product->getAverageMark()) {
                                    echo '<i class="fa fa-star"></i>';
                                } else
                                    echo '<i class="fa fa-star-o empty"></i>';

                            }
                            ?>


                        </div>

                        <h2 class="product-name">
                            <a href="<?= $url ?>"><?= $product->name ?></a>
                        </h2>
                        <div class="product-btns">
                            <?= Html::a('<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>', ['/site/add-to-favourites?id=' . $product->id]); ?>
                            <?= Html::a('<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Cart</button>', ['/site/add-to-cart', 'productId' => $product->id]); ?>

                        </div>
                        <?php


                        if ($product->availability <= 0) {
                            echo 'Out of stock';

                        } else if (Yii::$app->user->identity && Yii::$app->user->identity->status >= 2) {
                            echo '<form method="get" action="/admin/product-update">
                       <input type="hidden" name="id" value="' . $product->id . '">
                        <button type="submit">Update</button>
                       </form>';
                        }
                        ?>
                    </div>
                </div>
            </div>