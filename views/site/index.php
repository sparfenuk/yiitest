<?php

/* @var $this yii\web\View */
/* @var $pickedForYou[] app\models\Order */
/* @var $latestProducts[] app\models\Order */

use yii\helpers\Html;
use yii\web\view;
$this->title = 'E-Shop';

?>




	<!-- section -->
	<div class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-8">
					<div class="banner banner-1">
						<?php echo Html::img('@web/img/banner13.jpg',['alt' => '']);?>

						<div class="banner-caption text-center">
							<h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<?php echo Html::img('@web/img/banner11.jpg',['alt' => '']);?>

						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<?php echo Html::img('@web/img/banner12.jpg',['alt' => '']);?>

						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">

            <div class="row">
                <!-- section-title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="title">Deals Of The Day</h2>
                        <div class="pull-right">
                            <div class="product-slick-dots-1 custom-dots"></div>
                        </div>
                    </div>
                </div>
                <!-- /section-title -->

                <!-- banner -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="banner banner-2">
                        <img src="./img/banner14.jpg" alt="">
                        <div class="banner-caption">
                            <h2 class="white-color">NEW<br>COLLECTION</h2>
                            <button class="primary-btn">Shop Now</button>
                        </div>
                    </div>
                </div>
                <!-- /banner -->

                <!-- Product Slick -->
                <div class="col-md-9 col-sm-6 col-xs-6">
                    <div class="row">
                        <div id="product-slick-1" class="product-slick">
                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span>New</span>
                                        <span class="sale">-20%</span>
                                    </div>
                                    <ul class="product-countdown">
                                        <li><span>00 H</span></li>
                                        <li><span>00 M</span></li>
                                        <li><span>00 S</span></li>
                                    </ul>
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="./img/product01.jpg" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span class="sale">-20%</span>
                                    </div>
                                    <ul class="product-countdown">
                                        <li><span>00 H</span></li>
                                        <li><span>00 M</span></li>
                                        <li><span>00 S</span></li>
                                    </ul>
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="./img/product07.jpg" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span>New</span>
                                        <span class="sale">-20%</span>
                                    </div>
                                    <ul class="product-countdown">
                                        <li><span>00 H</span></li>
                                        <li><span>00 M</span></li>
                                        <li><span>00 S</span></li>
                                    </ul>
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="./img/product06.jpg" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span>New</span>
                                        <span class="sale">-20%</span>
                                    </div>
                                    <ul class="product-countdown">
                                        <li><span>00 H</span></li>
                                        <li><span>00 M</span></li>
                                        <li><span>00 S</span></li>
                                    </ul>
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="./img/product08.jpg" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->
                        </div>
                    </div>
                </div>
                <!-- /Product Slick -->
            </div>
            <!-- /row -->

			<!-- row -->
            <?php if ($latestProducts != null){ ?>
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Latest Products</h2>
					</div>
				</div>
				<!-- section title -->
                <?php
                    foreach ($latestProducts->all() as $productId) {
                        $product = \app\models\Product::find()->where(['id' => $productId->product_id])->one();
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
                                <?= Html::a('<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>',['/site/add-to-favourites?id='.$product->id]); ?>
                                <?= Html::a('<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>',['site/add-to-cart?productId='.$product->id]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->

                <?php } ?>


			</div>
                <?php } ?>
			<!-- /row -->

			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="banner banner-2">
						<?php echo Html::img('@web/img/banner15.jpg',['alt' => '']);?>

						<div class="banner-caption">
							<h2 class="white-color">NEW<br>COLLECTION</h2>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div>
				<!-- /banner -->

				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-20%</span>
							</div>
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i>view</button>
							<?php echo Html::img('@web/img/product07.jpg',['alt' => '']);?>

						</div>
						<div class="product-body">
							<h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Single -->

				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-20%</span>
							</div>
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
							<?php echo Html::img('@web/img/product06.jpg',['alt' => '']);?>

						</div>
						<div class="product-body">
							<h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Single -->

				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-20%</span>
							</div>
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
							<?php echo Html::img('@web/img/product05.jpg',['alt' => '']);?>

						</div>
						<div class="product-body">
							<h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Single -->
			</div>
			<!-- /row -->

            <?php if ($pickedForYou != null) { ?>
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Picked For You</h2>
					</div>
				</div>
				<!-- section title -->

                <?php
                    foreach ($pickedForYou->all() as $productId) {
                        $product = \app\models\Product::find()->where(['id' => $productId->product_id])->one();
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

                                    echo Html::img('@web/images/product_images/'.$image->image_name,['alt' => "",'style'=>' height: 200px;']);?>

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
                                        <?= Html::a('<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>',['/site/add-to-favourites?id='.$product->id]); ?>
                                        <?= Html::a('<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>',['site/add-to-cart?productId='.$product->id]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Product Single -->

                    <?php } ?>
			</div>
            <?php } ?>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->




