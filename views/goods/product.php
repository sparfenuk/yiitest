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
use app\models\Product;
use yii\widgets\ActiveForm;

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;






$name=ProductPhoto::findByProductId($product->id);
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
$photos=ProductPhoto::findByProductId($product->id);
   // var_dump($photos);





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


   $slickIndex=0;
   $tabIndex=0;
   foreach ($photos as $photo)
  {
      echo '
  
                          <div class="product-view slick-slide slick-current slick-active" data-slick-index="'.$slickIndex.'" aria-hidden="false" tabindex="'.$tabIndex.'" style="width: 555px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
								<img style="width:300px" src="' . Yii::$app->params['basePath'] . '/images/product_images/'. HTML::encode($photo->image_name).'" alt="">
							</div>';
    $tabIndex=-1;
    $slickIndex++;
  }



  echo'
							
							</div></div>
							
							
							
						</div>
						<div id="product-view" class="slick-initialized slick-slider">
							<div class="slick-list draggable" style="padding: 0px 50px;"><div class="slick-track" style="opacity: 1; width: 876px; transform: translate3d(-219px, 0px, 0px);">
						
							
						';

                                  $slickIndex= -1 * count($photos);

                                 foreach ($photos as $photo) {
                                     if ($tabIndex === -1) {

                                        echo  '<div class = "product-view slick-slide slick-cloned slick-active" data-slick-index="' . $slickIndex . '" aria-hidden="true" tabindex="-1" style="width: 73px;">
							                     	<img src = "' . Yii::$app->params['basePath'] . '/images/product_images/'. HTML::encode($photo->image_name).'" alt="">
							                    </div>';
                                     }
                                     else
                                         {
                                         echo  '<div class = "product-view slick-slide slick-cloned" data-slick-index="' . $slickIndex . '" aria-hidden="true" tabindex="-1" style="width: 73px;">
							                     	<img  src = "' . Yii::$app->params['basePath'] . '/images/product_images/'. HTML::encode($photo->image_name).'" alt="">
							                    </div>';
                                          }
                                     $tabIndex++;
                                 }




							echo'

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
								<span class="sale">-20%</span>
							</div>
							<h2 class="product-name">'. HTML::encode($product->name).'</h2>
							<h3 class="product-price">$'. HTML::encode(round($product->price)).' <del class="product-old-price">$45.00</del></h3>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
								<a href="#">3 Review(s) / Add Review</a>
							</div>
							<p><strong>Availability:</strong>'. HTML::encode($product->availability).'</p>
							<p><strong>Brand:</strong>'. HTML::encode($product->brand).'</p>
							<p>'. HTML::encode($product->description).'</p>
							

							
						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab1">Details</a></li>
								<li><a data-toggle="tab" href="#tab2">Reviews (3)</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<p>'. HTML::encode($product->description).'</p>
								</div>
								<div id="tab2" class="tab-pane fade in">

									<div class="row">
										<div class="col-md-6">
											<div class="product-reviews">
												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>

												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>

												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
														<div class="review-rating pull-right">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
															irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
													</div>
												</div>

												<ul class="reviews-pages">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="col-md-6">
											<h4 class="text-uppercase">Write Your Review</h4>
											<p>Your email address will not be published.</p>
											
											';


                     $form = ActiveForm::begin(); ?>

     <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'brand')->textInput(['maxlength' => true]) ?>

     <?= $form->field($product, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'price')->textInput(['type' => 'number']) ?>


    <?= $form->field($product, 'availability')->textInput(['type' => 'number'])->label('availability') ?>


    <?= $form->field($categories, 'name')->dropdownList(
        Category::find()->select(['name', 'id'])->indexBy('id')->column() )->label("Category")?>


    <?= $form->field($uploader, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($product, 'colors')->checkboxList([
        'black' => 'black',
        'blue' => 'blue',
        'rose'=>'rose',
        'gold'=>'gold',
        'pink'=>'pink'
    ]);

    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



										<form class="review-form">
												<div class="form-group">
													<input class="input" type="text" placeholder="Your Name">
												</div>
												<div class="form-group">
													<input class="input" type="email" placeholder="Email Address">
												</div>
												<div class="form-group">
													<textarea class="input" placeholder="Your review"></textarea>
												</div>
												<div class="form-group">
													<div class="input-rating">
														<strong class="text-uppercase">Your Rating: </strong>
														<div class="stars">
															<input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
															<input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
															<input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
															<input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
															<input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
														</div>
													</div>
												</div>
												<button class="primary-btn">Submit</button>
											</form>
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

';

if(is_array($product->colors)) {


   $arr= $product->colors;


    if ($product->availability >= 0) {

        $form = ActiveForm::begin(['action' => ['goods/add-to-card'], 'options' => ['method' => 'post']]);


        echo $form->field($product, 'colors')->radioList($arr)->label('Color');


        echo Html::hiddenInput('id', $product->id);


        echo '<div class="form-group">' .
            Html::submitButton('Save', ['class' => 'btn btn-success'])
            . '</div>';
        ActiveForm::end();

    }
    else
    {
        echo 'Out of stock';

    }
}


echo '</div>';

 ?>