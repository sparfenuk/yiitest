<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 09.01.2019
 * Time: 19:05
 */


/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use app\models\ProductPhoto;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use app\models\Review;


$this->title = 'E-Shop' . $product->name;
$this->params['breadcrumbs'][0] = ['label' => $product->category->name, 'link' => '/goods/category?id='.$product->category->id];
$this->params['breadcrumbs'][1] = ['label' => $product->name, 'link' => Yii::$app->request->url];

$name = ProductPhoto::findByProductId($product->id);
$photos = ProductPhoto::findByProductId($product->id);
Review::getAverageReview(11); // todo: вивести для товару зірочками
?>

<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view" class="slick-initialized slick-slider">
						<button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: block;">Previous</button>
							<div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 2220px;">

<?php
$slickIndex = 0;
$tabIndex = 0;
foreach ($photos as $photo) {
    echo '
  
                          <div class="product-view slick-slide slick-current slick-active" data-slick-index="' . $slickIndex . '" aria-hidden="false" tabindex="' . $tabIndex . '" style="width: 555px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
								<img style="width:300px" src="' . '/images/product_images/' . HTML::encode($photo->image_name) . '" alt="">
							</div>';
    $tabIndex = -1;
    $slickIndex++;
}


echo '
							
						
						
							</div>
							<button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: block;">Previous</button>
                        </div>
							
							
							
						</div>
						<div id="product-view" class="slick-initialized slick-slider">
							<div class="slick-list draggable" style="padding: 0px 50px;"><div class="slick-track" style="opacity: 1; width: 876px; transform: translate3d(-219px, 0px, 0px);">
						
							
						';

$slickIndex = -1 * count($photos);

foreach ($photos as $photo) {
    if ($tabIndex === -1) {

        echo '<div class = "product-view slick-slide slick-cloned slick-active" data-slick-index="' . $slickIndex . '" aria-hidden="true" tabindex="-1" style="width: 73px;">
							                     	<img src = "' . '/images/product_images/' . HTML::encode($photo->image_name) . '" alt="">
							                    </div>';
    } else {
        echo '<div class = "product-view slick-slide slick-cloned" data-slick-index="' . $slickIndex . '" aria-hidden="true" tabindex="-1" style="width: 73px;">
							                     	<img  src = "' . '/images/product_images/' . HTML::encode($photo->image_name) . '" alt="">
							                    </div>';
    }
    $tabIndex++;
}


?>

</div></div>


</div>
</div>
<div class="col-md-6">
    <div class="product-body">
        <div class="product-label">

            <span>New</span>
            <?php

            //todo:: date compare

            ?>

            <?php
                $p = $product->getDiscount();
                if ($p !== null) {
                    echo '<span class="sale">-' . round($p) . '%</span>';
                }
            ?>


        </div>
        <h2 class="product-name">   <?= HTML::encode($product->name) ?>   </h2>


        <h3 class="product-price">  <?= HTML::encode(round($product->price)) ?>

            <?php

            if ($product->prev_price != 0) {
                echo '<del class="product-old-price">' . round($product->prev_price) . '</del>';

            }


            ?>


        </h3>
        <div>
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
            <a href="#"> <?= $reviewDataProvider->getTotalCount() ?> Review / Add Review</a>
        </div>
        <p><strong>Availability:</strong> <?= HTML::encode($product->availability) ?>  </p>
        <p><strong>Brand:</strong> <?= HTML::encode($product->brand) ?>   </p>


        <?php

        foreach ($product->description as $key => $value) {

            echo '<p><strong>' . HTML::encode($key) . ': &nbsp &nbsp </strong> ' . HTML::encode($value) . '</p>';

        }

        ?>


    </div>
</div>
<div class="col-md-12">
    <div class="product-tab">
        <ul class="tab-nav">

            <li class="active"><a data-toggle="tab" href="#tab1">Details</a></li>
            <li><a data-toggle="tab" href="#tab2">Add to cart</a></li>
            <li><a data-toggle="tab" href="#tab3">Reviews (<?= $reviewDataProvider->getTotalCount() ?>)</a></li>

        </ul>
        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">
                <?php

                foreach ($product->description as $key => $value) {

                    echo '<p><strong>' . HTML::encode($key) . ': &nbsp &nbsp </strong> ' . HTML::encode($value) . '</p>';

                }

                ?>
            </div>
            <div id="tab2" class="tab-pane fade in">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        if (is_array($product->colors)) {


                            $arr = $product->colors;
                            $arr = array_combine($arr, $arr);

                            if ($product->availability >= 0) {

                                // $form = ActiveForm::begin(['action' => ['/site/add-to-cart'], 'options' => ['method' => 'get']]);
                                echo Html::beginForm(['/site/add-to-cart', 'productId' => $product->id], 'get', ['enctype' => 'multipart/form-data']);
                                // echo  Html::hiddenInput('productId', $product->id);

                                // echo  $form->field($product, 'color')->radioList($arr)->label('Color');

                                echo Html::radioList('color', null, $arr);

//                                            echo  Html::input('number','quantity',1,['max'=>$product->availability , 'min'=>1]);


                                echo '<div class="help-block"></div>';

                                echo '<div class="form-group">' .
                                    Html::submitButton('Add to cart', ['class' => 'btn btn-success'])
                                    . '</div>';

                                echo Html::endForm();

                            } else {
                                echo 'Out of stock';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div id="tab3" class="tab-pane fade in">

                <div class="row">
                    <div class="col-md-6">
                        <div class="product-reviews">
                            <?php
                            foreach ($reviewDataProvider->models as $review) {
                                $user = $review->getUser();
                                echo '<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i>' . Html::encode($user->username) . '</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i>' . $review->created_at . '</a></div>
														<div class="review-rating pull-right">
														   ';
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < $review->mark)
                                        echo '<i class="fa fa-star"></i>';
                                    else
                                        echo '<i class="fa fa-star-o empty"></i>';
                                }
                                echo '    										</div>
													</div>
													<div class="review-body">
														<p>' . Html::encode($review->description) . '</p>
													</div>
												</div>';

                            }


                            ?>

                            <div> <?= LinkPager::widget(['pagination' => $reviewDataProvider->pagination]) ?>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <?php if (Yii::$app->user->isGuest !== true) {
                            ?>
                            <h4 class="text-uppercase">Write Your Review</h4>


                            <?php


                            $form = ActiveForm::begin([
                                'action' => '/goods/add-review',
                                'options' => [
                                    'class' => 'review-form',

                                ]
                            ]);
                            ?>


                            <div class="form-group">


                                <?= $form->field($review, 'description')->textarea(['rows' => '6'])->label('Your review') ?>

                                <div class="form-group">
                                    <div class="input-rating">
                                        <strong class="text-uppercase">Your Rating: </strong>
                                        <div class="stars">
                                            <input type="radio" id="star5" name="mark" value="5"><label
                                                    for="star5"></label>
                                            <input type="radio" id="star4" name="mark" value="4"><label
                                                    for="star4"></label>
                                            <input type="radio" id="star3" name="mark" value="3"><label
                                                    for="star3"></label>
                                            <input type="radio" id="star2" name="mark" value="2"><label
                                                    for="star2"></label>
                                            <input type="radio" id="star1" name="mark" value="1"><label
                                                    for="star1"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?= Html::hiddenInput('product_id', $product->id) ?>

                            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>

                            <?php ActiveForm::end();
                        } ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

</div>
<!-- /Product Details -->
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>


