<?php
/**
 */
use yii\helpers\Html;
?>



<?php if ($favourites != null){ ?>
<div class="row">
    <!-- section title -->
    <div class="col-md-12">
        <div class="section-title">
            <h2 class="title">Favourites</h2>
        </div>
    </div>
    <!-- section title -->
    <?php
    foreach ($favourites as $favourite) {

        $product = \app\models\Product::find()->where(['id' => $favourite->product_id])->one();
        ?>
        <!-- Product Single -->
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="product product-single">
                <div class="product-thumbbbb">
                    <?php
                    $discount = $product->getDiscount();
                    $isNew = $product->isNew();
                    if($isNew || $discount){ ?>
                        <div class="product-label">
                            <?php if($isNew) echo '<span>New</span>';
                            if($discount!= null) echo '<span class="sale">-'.$discount.'%</span>'; ?>
                        </div>
                    <?php } ?>
                    <?= Html::a('<button class="main-btn quick-view"><i class="fa fa-search-plus"></i>view</button>',['/goods/product?id='.$product->id]) ?>
                    <?php $image = \app\models\ProductPhoto::find()->where(['product_id' => $product->id])->one();

                    echo Html::img('@web/images/product_images/'.$image->image_name,['alt' => "product",'style'=>' height: 200px;']);?>

                </div>

                <div class="product-body">
                    <h3 class="product-price"><?= round($product->price).'₴' ?>
                        <del class="product-old-price">
                            <?php if($product->prev_price) echo round($product->prev_price).'₴'; ?>
                        </del>
                    </h3>

                    <div class="product-rating">
                        <?php $average = round(\app\models\Review::getAverageReview($product->id));
                        for( $i = 0; $i < 5 ;$i++)
                        {
                            if ($i<$average)
                            {
                                echo '<i class="fa fa-star"></i>';
                            }
                            else
                                echo '<i class="fa fa-star-o empty"></i>';

                        }
                        echo '('.\app\models\Review::find()->where(['product_id' => $product->id])->count('id').')';

                        ?>


                    </div>
                    <h2 class="product-name"><?= Html::a($product->name,['/goods/product?id='.$product->id])?></h2>
                    <div class="product-btns">
                        <?= Html::a('<button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>',['/goods/product?id='.$product->id]) ?>
                        <?= Html::a('<button class="main-btn icon-btn"><i class="fa fa-heart-o"></i></button>',['/site/delete-from-favourites?id='.$favourite->id]); ?>
                        <?= Html::a('<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>',['site/add-to-cart?productId='.$product->id]) ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Product Single -->

    <?php } ?>
<?php } ?>
