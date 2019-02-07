<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 09.01.2019
 * Time: 19:05
 */


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
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

use app\models\Product;
use app\models\Review;


$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;


$name = ProductPhoto::findByProductId($product->id);
// var_dump($name);
//
//echo '<div class="product-details">
//
//<div class="product-name" style="font-size: 20pt ;">
//'. HTML::encode($product->name).'
//</div>
//<br>
//<br>
//<img style="width: 500px" src="'. Yii::$app->params['basePath'] . '/images/product_images/'. HTML::encode($name).'">
//
//<h3 class="product-price">
//'. HTML::encode($product->price).'
//</h3>
//
//<div class="product-details">
//
//'. HTML::encode($product->description).'
//
//<br>
//<br>
//<br>
//<br>
//</div>';


//<img style="width: 500px" src="'. Yii::$app->params['basePath'] . '/images/'. HTML::encode($name).'">
$photos = ProductPhoto::findByProductId($product->id);
// var_dump($photos);

Review::getAverageReview(11); // todo: вивести для товару зірочками
echo '

<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view" class="slick-initialized slick-slider">
							<div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 2220px;"> 
							';


$slickIndex = 0;
$tabIndex = 0;
foreach ($photos as $photo) {
    echo '
  
                          <div class="product-view slick-slide slick-current slick-active" data-slick-index="' . $slickIndex . '" aria-hidden="false" tabindex="' . $tabIndex . '" style="width: 555px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
								<img style="width:300px" src="' . Yii::$app->params['basePath'] . '/images/product_images/' . HTML::encode($photo->image_name) . '" alt="">
							</div>';
    $tabIndex = -1;
    $slickIndex++;
}


echo '
							
						
						
							</div></div>
							
							
							
						</div>
						<div id="product-view" class="slick-initialized slick-slider">
							<div class="slick-list draggable" style="padding: 0px 50px;"><div class="slick-track" style="opacity: 1; width: 876px; transform: translate3d(-219px, 0px, 0px);">
						
							
						';

$slickIndex = -1 * count($photos);

foreach ($photos as $photo) {
    if ($tabIndex === -1) {

        echo '<div class = "product-view slick-slide slick-cloned slick-active" data-slick-index="' . $slickIndex . '" aria-hidden="true" tabindex="-1" style="width: 73px;">
							                     	<img src = "' . Yii::$app->params['photos_path']  . HTML::encode($photo->image_name) . '" alt="">
							                    </div>';
    } else {
        echo '<div class = "product-view slick-slide slick-cloned" data-slick-index="' . $slickIndex . '" aria-hidden="true" tabindex="-1" style="width: 73px;">
							                     	<img  src = "' . Yii::$app->params['photos_path'] . HTML::encode($photo->image_name) . '" alt="">
							                    </div>';
    }
    $tabIndex++;
}


?>

							<div class="product-view slick-slide slick-current slick-active slick-center" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 73px;">
								<img src="../../siteMainPageTemplate/e-shop/img/thumb-product01.jpg" alt="">
							</div>
							
							<div class="product-view slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="0" style="width: 73px;">
								<img src="../../siteMainPageTemplate/e-shop/img/thumb-product02.jpg" alt="">
							</div>
							
							<div class="product-view slick-slide" data-slick-index="2" aria-hidden="true" tabindex="0" style="width: 73px;">
								<img src="../../siteMainPageTemplate/e-shop/img/thumb-product03.jpg" alt="">
							</div>
							<div class="product-view slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1" style="width: 73px;">
								<img src="../../siteMainPageTemplate/e-shop/img/thumb-product04.jpg" alt="">
							</div>
							<div class="product-view slick-slide slick-cloned slick-center" data-slick-index="4" aria-hidden="true" tabindex="-1" style="width: 73px;">
								<img src="../../siteMainPageTemplate/e-shop/img/thumb-product01.jpg" alt="">
							</div>
							<div class="product-view slick-slide slick-cloned" data-slick-index="5" aria-hidden="true" tabindex="-1" style="width: 73px;">
								<img src="../../siteMainPageTemplate/e-shop/img/thumb-product02.jpg" alt="">
							</div>
							<div class="product-view slick-slide slick-cloned" data-slick-index="6" aria-hidden="true" tabindex="-1" style="width: 73px;">
								<img src="../../siteMainPageTemplate/e-shop/img/thumb-product03.jpg" alt="">
							</div>
							<div class="product-view slick-slide slick-cloned" data-slick-index="7" aria-hidden="true" tabindex="-1" style="width: 73px;">
								<img src="../../siteMainPageTemplate/e-shop/img/thumb-product04.jpg" alt="">
							</div>
							
							
							
							
							
							
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
<!---->
<!--                                --><?php
//
//                                if($product->prev_price!=0 && $product->price < $product->prev_price)
//                                {
//                                    $p = ($product->prev_price * $product->price)/100;
//                                    echo'<span class="sale">'.$p.'</span>';
//                                }
//
//                                ?>



							</div>
							<h2 class="product-name">   <?= HTML::encode($product->name) ?>   </h2>


							<h3 class="product-price">  <?= HTML::encode(round($product->price))  ?>

<!--                                --><?php
//
//                                if($product->prev_price != 0)
//                                {
//                                 echo'<del class="product-old-price">'.$product->prev_price.'</del>';
//
//                                }
//
//
//                                ?>



                            </h3>
							<div>
								<div class="product-rating">
                                    <?php
                                    for( $i = 0; $i < 5 ;$i++)
                                    {
                                        if ($i<$average)
                                        {
                                            echo '<i class="fa fa-star"></i>';
                                        }
                                        else
                                            echo '<i class="fa fa-star-o empty"></i>';

                                    }
                                    ?>


								</div>
								<a href="#"><?= $reviewDataProvider->getTotalCount() ?> Review / Add Review</a>
							</div>
							<p><strong>Availability:</strong>  <?= HTML::encode($product->availability) ?>  </p>
							<p><strong>Brand:</strong>  <?= HTML::encode($product->brand) ?>   </p>


                            <?php

                            foreach ($product->description as $key => $value)
                            {

                                echo '<p><strong>'.HTML::encode($key).': &nbsp &nbsp </strong> '.HTML::encode($value).'</p>';

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

                                    foreach ($product->description as $key => $value)
                                    {

                                        echo '<p><strong>'.HTML::encode($key).': &nbsp &nbsp </strong> '.HTML::encode($value).'</p>';

                                    }

                                    ?>
								</div>
                                <div id="tab2" class="tab-pane fade in">
                                    <div class="row">
                                        <div class="col-md-6">
                                    <?php
                                    if (is_array($product->colors)) {


                                        $arr = $product->colors;
                                        $arr=array_combine($arr,$arr);

                                        if ($product->availability >= 0) {

                                            // $form = ActiveForm::begin(['action' => ['/site/add-to-cart'], 'options' => ['method' => 'get']]);
                                            echo  Html::beginForm(['/site/add-to-cart', 'productId' => $product->id], 'get', ['enctype' => 'multipart/form-data']);
                                            // echo  Html::hiddenInput('productId', $product->id);

                                            // echo  $form->field($product, 'color')->radioList($arr)->label('Color');

                                            echo Html::radioList('color',null,$arr);

                                            echo  Html::input('number','quantity',1,['max'=>$product->availability , 'min'=>1]);




                                            echo  '<div class="help-block"></div>';

                                            echo  '<div class="form-group">' .
                                                Html::submitButton('Add to cart', ['class' => 'btn btn-success'])
                                                .'</div>';

                                            echo  Html::endForm();

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
    //  echo var_dump($user);
    echo                                          '<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i>' .Html::encode($user->username) . '</a></div>
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
														<p>' .Html::encode( $review->description) . '</p>
													</div>
												</div>';

}


?>

 <div> <?= LinkPager::widget(['pagination' => $reviewDataProvider->pagination])?>





         </div>
											</div>
										</div>

										<div class="col-md-6">
                                            <?php if (Yii::$app->user->isGuest!==true)
                                            {
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



<div class="form-group" >



<?= $form->field($review, 'description')->textarea(['rows' => '6'])->label('Your review')?>

	                                         <div class="form-group">
													<div class="input-rating">
														<strong class="text-uppercase">Your Rating: </strong>
														<div class="stars">
															<input type="radio" id="star5" name="mark" value="5"><label for="star5"></label>
															<input type="radio" id="star4" name="mark" value="4"><label for="star4"></label>
															<input type="radio" id="star3" name="mark" value="3"><label for="star3"></label>
															<input type="radio" id="star2" name="mark" value="2"><label for="star2"></label>
															<input type="radio" id="star1" name="mark" value="1"><label for="star1"></label>
														</div>
													</div>
												</div>
                                             </div>

                            <?= Html::hiddenInput('product_id',$product->id) ?>

<?=    Html::submitButton('Submit', ['class' => 'btn btn-success'])   ?>

<?php    ActiveForm::end(); } ?>



    <!---->
    <!--										<form class="review-form" method="post">-->
    <!--												<div class="form-group">-->
    <!--													<input class="input" type="text" placeholder="Your Name">-->
    <!--												</div>-->
    <!--												<div class="form-group">-->
    <!--													<input class="input" type="email" placeholder="Email Address">-->
    <!--												</div>-->
    <!--												<div class="form-group">-->
    <!--													<textarea class="input" placeholder="Your review"></textarea>-->
    <!--												</div>-->
    <!--												<div class="form-group">-->
    <!--													<div class="input-rating">-->
    <!--														<strong class="text-uppercase">Your Rating: </strong>-->
    <!--														<div class="stars">-->
    <!--															<input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>-->
    <!--															<input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>-->
    <!--															<input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>-->
    <!--															<input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>-->
    <!--															<input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>-->
    <!--														</div>-->
    <!--													</div>-->
    <!--												</div>-->
    <!--												<button class="primary-btn" >Submit</button>-->
    <!--											</form>-->
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


