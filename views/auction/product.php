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


$this->title = 'E-Shop' . $product->name;
$this->params['breadcrumbs'][0] = ['label' => $product->category->name, 'link' => '/goods/category?id='.$product->category->id];
$this->params['breadcrumbs'][1] = ['label' => $product->name, 'link' => Yii::$app->request->url];
$mainPhoto = '';
if(isset($photos[0]->image_name))
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
                            for ($i=0; $i < count($photos); $i++) {
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
        </div>
        <h2 class="product-name"> <?= HTML::encode($product->name) ?></h2>
        <h3>time left <?= $product->time - new DateTime() ?></h3>
        <h3 class="product-price"> <?= HTML::encode(round($product->current_price)) ?>₴ (11bids)<!--TODO: bits count-->
        </h3>
        <h2 class="product-price">
            <input type="number" name="amount" id="newBidValue" min="<?= round($product->current_price+1) ?>" max="1000000" value="<?= round($product->current_price+1) ?>">
            <button id="makeBid" class="primary-btn">make bit!</button>
        </h2>

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
                <p><?= $product->description ?></p>
            </div>
            <div id="tab2" class="tab-pane fade in">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                                echo Html::beginForm(['/site/add-to-cart', 'productId' => $product->id], 'get', ['enctype' => 'multipart/form-data']);
                                echo '<div class="help-block"></div>';
                                echo '<div class="form-group">' .
                                    Html::submitButton('Add to cart', ['class' => 'btn btn-success'])
                                    . '</div>';

                                echo Html::endForm();
                        ?>
                    </div>
                </div>
            </div>
            <div id="tab3" class="tab-pane fade in">
                <div class="row">
                    <div class="col-md-6">
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
        let src = e.currentTarget.childNodes.item(1).getAttribute('src');
        $('.main-image').attr('src',src);
        $('.main-photo').css('background-image', 'url('+src+')');
    });

    function preventNumberInput(e){
        var keyCode = (e.keyCode ? e.keyCode : e.which);
        if (keyCode > 47 && keyCode < 58 || keyCode > 95 && keyCode < 107 ){
            e.preventDefault();
        }
    }

    $(document).ready(function () {

        $('#newBidValue').keypress(function(e) {
            if ($(this).val().length > 5)
            {
                preventNumberInput(e);
            }
        });

        // var conn = new WebSocket('ws://localhost:8083');
        // conn.onopen = function(e) {
        //     console.log(e);
        // };
        //
        // conn.onmessage = function(e) {
        //     console.log(e.data);
        // };
        //
//
        // $('#makeBit').click(function (){
        //     var allo = "adwdaad1wdwawd";
        //     conn.send(allo);
        //     console.log('al1lo');
        // });


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
                    {
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

    $('#makeBid').click(function (){
        console.log('allo');
        $.ajax({
            method: 'POST',
            url: '/auction/make_bid',
            data: {
                product: '<?= $product->id ?>',
                user: '<?= Yii::$app->user->id ?>',
                amount: $('#newBidValue').val()
            },
            success: function (res) {
                console.log(res);
            },
            error: function (res) {
                console.log(res);
            }
        })
    });

</script>
