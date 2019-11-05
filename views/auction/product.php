<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 09.01.2019
 * Time: 19:05
 */


/* @var $this \yii\web\View */

/* @var $product ProductAuction
/* @var $content string */

use app\models\ProductAuction;
use yii\helpers\Html;
use app\models\ProductPhoto;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use app\models\Review;


$this->title = 'E-Shop' . $product->name;
$this->params['breadcrumbs'][0] = ['label' => $product->category->name, 'link' => '/goods/category?id='.$product->category->id];
$this->params['breadcrumbs'][1] = ['label' => $product->name, 'link' => Yii::$app->request->url];

//TODO: перенести в контроллер


if(isset($photos[1]->image_name))
{
    $mainPhoto = $photos[1]->image_name;
}
else
{
    $mainPhoto = $photos[0]->image_name;
}


?>
<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
                            <figure class="main-photo zoom" style="background-image: url(<?='/images/product_images/'. HTML::encode($mainPhoto)?>);" onmousemove= zoom(event)>
                             <img class="main-image" style="width: 100%;" src="<?='/images/product_images/'. HTML::encode($mainPhoto)?>" alt="">
                            </figure>
                            <div class="photos" style="overflow: auto; height: 400px; float: left; width: 25%; ">
                            <?php
                            for ($i=1; $i < count($photos); $i++) {
                            ?>
                                <div class="product-image" style="display: inline-block;">
                                <img id="img" style="width: 100%;" src="<?='/images/product_images/'. HTML::encode($photos[$i]->image_name)?>" alt="">
                                </div>
                            <?php
                            }
                            ?>
                            </div>
                    </div>
<div class="col-md-6">
    <div class="product-body">
        <div class="product-label">
            <span>New</span>
            <?php
            //todo:: date compare
            ?>

<!--            --><?php
//                $p = $product->getDiscount();
//                if ($p !== null) {
//                    echo '<span class="sale">-' . round($p) . '%</span>';
//                }
//            ?>
        </div>
        <h2 class="product-name"> <?= HTML::encode($product->name) ?></h2>
        <h3 class="product-price"> <?= HTML::encode(round($product->current_price)) ?>
        </h3>
        <h2 class="product-price">
            max price - <?= round($product->max_price).'₴' ?>
        </h2>
        <div>
<!--            <div class="product-rating">-->
<!--                --><?php
//                for ($i = 0; $i < 5; $i++) {
//                    if ($i < $product->getAverageMark()) {
//                        echo '<i class="fa fa-star"></i>';
//                    } else
//                        echo '<i class="fa fa-star-o empty"></i>';
//                }
//                ?>
<!--            </div>-->
<!--            <a href="#review-form"> --><?//= $reviewDataProvider->getTotalCount() ?><!-- Review / Add Review</a>-->
        </div>
<!--        --><?php
//        foreach ($product->description as $key => $value) {
//
//            echo '<p><strong>' . HTML::encode($key) . ': &nbsp &nbsp </strong> ' . HTML::encode($value) . '</p>';
//
//        }
//        ?>
        <p><?= $product->description ?></p>
    </div>
</div>
<div class="col-md-12">
    <div class="product-tab">
        <ul class="tab-nav">
            <li class="active"><a data-toggle="tab" href="#tab1">Details</a></li>
            <li><a data-toggle="tab" href="#tab2">Add to cart</a></li>
<!--            <li><a data-toggle="tab" href="#tab3">Reviews (--><?//= $reviewDataProvider->getTotalCount() ?><!--)</a></li>-->
        </ul>
        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">
<!--                --><?php
//                foreach ($product->description as $key => $value) {
//                    echo '<p><strong>' . HTML::encode($key) . ': &nbsp &nbsp </strong> ' . HTML::encode($value) . '</p>';
//                }
//                ?>
                <p><?= $product->description ?></p>
            </div>
            <div id="tab2" class="tab-pane fade in">
                <div class="row">
                    <div class="col-md-6">
                        <?php
//                        if (is_array($product->colors)) {
//                            $arr = $product->colors;
//                            $arr = array_combine($arr, $arr);
//                            if ($product->availability >= 0) {
                                // $form = ActiveForm::begin(['action' => ['/site/add-to-cart'], 'options' => ['method' => 'get']]);
                                echo Html::beginForm(['/site/add-to-cart', 'productId' => $product->id], 'get', ['enctype' => 'multipart/form-data']);
                                // echo  Html::hiddenInput('productId', $product->id);
                                // echo  $form->field($product, 'color')->radioList($arr)->label('Color');
//                                echo Html::radioList('color', null, $arr);
//                                            echo  Html::input('number','quantity',1,['max'=>$product->availability , 'min'=>1]);
                                echo '<div class="help-block"></div>';
                                echo '<div class="form-group">' .
                                    Html::submitButton('Add to cart', ['class' => 'btn btn-success'])
                                    . '</div>';

                                echo Html::endForm();

//                            } else {
//                                echo 'Out of stock';
//                            }
//                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="tab3" class="tab-pane fade in">
                <div class="row">
                    <div class="col-md-6">
<!--                        <div class="product-reviews">-->
<!--                            --><?php
//                            foreach ($reviewDataProvider->models as $review) {
//                                $user = $review->getUser();
//                                echo '<div class="single-review">'
//													.'<div class="review-heading">'
//														.'<div><a href="#"><i class="fa fa-user-o"></i>' . Html::encode($user->username) . '</a></div>'
//														.'<div><a href="#"><i class="fa fa-clock-o"></i>' . $review->created_at . '</a></div>'
//														.'<div class="review-rating pull-right">';
//                                for ($i = 0; $i < 5; $i++) {
//                                    if ($i < $review->mark)
//                                        echo '<i class="fa fa-star"></i>';
//                                    else
//                                        echo '<i class="fa fa-star-o empty"></i>';
//                                }
//                                echo '</div>'
//									.'</div>'
//                                    .'<div class="review-body">'
//								    	.'<p>'. Html::encode($review->description).'</p>'
//                                    .'</div>'
//                                .'</div>';
//                            }
//                            ?>
<!--                            <div>-->
<!--                                --><?//= LinkPager::widget(['pagination' => $reviewDataProvider->pagination]) ?>
<!--                            </div>-->
<!--                        </div>-->
                    </div>
<!--                    <div class="col-md-6">-->
<!--                        --><?php //if (Yii::$app->user->isGuest !== true) { ?>
<!--                            <h4 class="text-uppercase">Write Your Review</h4>-->
<!--                            --><?php
//                            $form = ActiveForm::begin([
//                                'action' => '/goods/add-review',
//                                'options' => [
//                                    'class' => 'review-form',
//                                    'id' => 'review-form'
//                                ]
//                            ]);
//                            ?>
<!--                            <div class="form-group" id="review-form">-->
<!--                                --><?//= $form->field($review, 'description')->textarea(['rows' => '6'])->label('Your review') ?>
<!--                                <div class="form-group">-->
<!--                                    <div class="input-rating">-->
<!--                                        <strong class="text-uppercase">Your Rating: </strong>-->
<!--                                        <div class="stars">-->
<!--                                            <input type="radio" id="star5" name="mark" value="5"><label-->
<!--                                                    for="star5"></label>-->
<!--                                            <input type="radio" id="star4" name="mark" value="4"><label-->
<!--                                                    for="star4"></label>-->
<!--                                            <input type="radio" id="star3" name="mark" value="3"><label-->
<!--                                                    for="star3"></label>-->
<!--                                            <input type="radio" id="star2" name="mark" value="2"><label-->
<!--                                                    for="star2"></label>-->
<!--                                            <input type="radio" id="star1" name="mark" value="1"><label-->
<!--                                                    for="star1"></label>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            --><?//= Html::hiddenInput('product_id', $product->id) ?>
<!--                            <div class="alert-block"></div>-->
<!--                            --><?//= Html::submitButton('Submit', ['class' => 'btn btn-success', 'id'=>'send-review']) ?>
<!--                            --><?php //ActiveForm::end();
//                        } ?>
<!--                    </div>-->
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

<script src="/js/image_zoom.js"></script>

<link href="/css/image_zoom.css" rel="stylesheet">
<script>

    function zoom(e){
        var zoomer = e.currentTarget;
        e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX;
        e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX;
        x = offsetX/zoomer.offsetWidth*100;
        y = offsetY/zoomer.offsetHeight*100;
        zoomer.style.backgroundPosition = x + '% ' + y + '%';
    }

    $('.product-image').click(function (e) {
        var src = e.currentTarget.childNodes.item(1).getAttribute('src');
        $('.main-image').attr('src',src);
        $('.main-photo').css('background-image', 'url('+src+')');
    });

    $(document).ready(function () {
        $('#review-form').submit( function(e){
                e.preventDefault();
                var alert = $('.alert-block');

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function(data)
                    {+
                       alert.html('').fadeIn().delay(10000).fadeOut();
                       alert.append('<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'
                                     +'<h4><i class="icon fa fa-check"></i>Your comment will be posted after moderation</h4></div>');
                    },
                    error: function (data) {
                        alert.html('').fadeIn().delay(10000).fadeOut();
                        alert.append('<div class="alert alert-warning alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'
                            +'<h4><i class="icon fa fa-check"></i>data.errors</h4></div>');
                    }
                });
            });
        });

</script>
<?//=
//$this->registerJsFile('@web/js/single_prod.js');
//?>
