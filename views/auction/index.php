<?php
/* @var $this yii\web\View */

use app\models\Category;
use app\models\ProductAuction;
use app\models\ProductPhoto;
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][0] = ['label' => $this->title, 'link' => Yii::$app->request->url];
?>
<div id="main" class="col-md-12"  >
    <div id="store">
        <div class="col-md-12">
            <div class="section-title">
                <a href="">
                    <h2 class="title"></h2>
                </a>
            </div>
            <div class = "row">
        <? foreach ($products as $picker) { ?>
            <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="product product-single">
                <div class="product-thumb">
                    <div class="product-label">

                    </div>
                    <?= Html::a('<button class="main-btn quick-view"><i class="fa fa-search-plus"></i>view</button>', ['/goods/product?id=' . $picker->id]) ?>
                    <?php $image = \app\models\ProductAuctionPhoto::find()->where(['product_id' => $picker->id])->one();
                    if($image)
                    {
                        echo Html::img('@web/images/product_images/' . $image->image_name, ['alt' => "product", 'style' => ' height: 200px;']);
                    }
                    ?>
                </div>
                <div class="product-body">
                    <h3 class="product-price">
                        highest bet - <?= round($picker->current_price).'₴' ?>
                    </h3>
                    <h2 class="product-price">
                        max price - <?= round($picker->max_price).'₴' ?>
                    </h2>
                    <div>
                        <?php $average = round(\app\models\Review::getAverageReview($picker->id));
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $average) {
                                echo '<i class="fa fa-star"></i>';
                            } else
                                echo '<i class="fa fa-star-o empty"></i>';

                        }
                        echo '(' . \app\models\Review::find(    )->where(['product_id' => $picker->id])->count('id') . ')';

                        ?>
                    </div>
                    <h2 class="product-name"><?= Html::a($picker->name, ['/auction/product?id=' . $picker->id]) ?></h2>
                    <div class="product-btns">
                        <?= Html::a('<button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>', ['/auction/product?id=' . $picker->id]) ?>
                        <?= Html::a('<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>', ['/site/add-to-favourites?id=' . $picker->id]); ?>
                        <?= Html::a('<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>', ['site/add-to-cart?productId=' . $picker->id]) ?>
                    </div>
                </div>
            </div>
            </div>
            <!-- /Product Single -->
        <?php } ?>
        <?php
//        foreach ($products   as $prod) {
//            if ($prod !== null) {
//                echo '
//                   <div class="col-md-12">
//                    <div class = "row">';
//                    $url = Url::toRoute(['goods/product', 'id' => $prod->id]);
//                    $name = ProductPhoto::find()->where(['product_id' => $prod->id])->one();
//                    ?>
<!--                    <div class="col-md-4 col-sm-6 col-xs-6">-->
<!--                        <div class="product product-single">-->
<!--                            <div class="product-thumb" >-->
<!--                                <div class="product-label">-->
<!--                                    --><?php
//                                   if($prod->isNew())
//                                    {
//                                        echo '	<span>New</span>';
//                                    }
//                                    ?>
<!---->
<!--                                </div>-->
<!---->
<!--                                <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>-->
<!--                                <img style = "width: 100%;" src="--><?//='/images/product_images/' . HTML::encode($name->image_name)?><!--" >-->
<!---->
<!--                            </div>-->
<!---->
<!--                            <div class="product-body">-->
<!---->
<!--                                <h3 class="product-price"> --><?//=round($prod->price)?>
<!--                                    --><?php
//
//                                    if($prod->prev_price != 0)
//                                    {
//                                        echo'<del class="product-old-price">'.round($prod->prev_price).'</del>';
//
//                                    }
//                                    ?>
<!---->
<!--                                </h3>-->
<!---->
<!--                                <div class="product-rating">-->
<!--                                    --><?php
//                                    for( $i = 0; $i < 5 ;$i++)
//                                    {
//                                        if ($i<$prod->getAverageMark())
//                                        {
//                                            echo '<i class="fa fa-star"></i>';
//                                        }
//                                        else
//                                            echo '<i class="fa fa-star-o empty"></i>';
//
//                                    }
//                                    ?>
<!---->
<!---->
<!--                                </div>-->
<!---->
<!--                                <h2 class="product-name">-->
<!--                                    <a href="--><?//= $url ?><!--">--><?//= $prod->name ?><!--</a>-->
<!--                                </h2>-->
<!--                                <div class="product-btns">-->
<!--                                    --><?//= Html::a('<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>',['/site/add-to-favourites?id='.$prod->id]); ?>
<!---->
<!---->
<!--                                    --><?//= Html::a('<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Cart</button>',['/site/add-to-cart', 'productId' => $prod->id]); ?>
<!---->
<!--                                </div>-->
<!--                                --><?php
//
//
//                                if ($prod->availability <= 0) {
//                                    echo 'Out of stock';
//
//                                }
//                                else if(Yii::$app->user->identity && Yii::$app->user->identity->status >= 2)
//                                {
//
//
//                                    // admin/product-update?id=1
//                                    echo '<form method="get" action="/admin/product-update">
//                                           <input type="hidden" name="id" value="'.$prod->id.'">
//                                            <button type="submit">Update</button>
//                                           </form>';
//                                }
//                                ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    --><?php
//                }
//                echo '</div>';
//            }
        ?>
    </div>
</div>


