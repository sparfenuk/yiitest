<?php

/* @var $this \yii\web\View */
/* @var $this \yii\
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$this->registerJsFile('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js');
$this->registerJsFile('https://oss.maxcdn.com/respond/1.4.2/respond.min.js');

?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>
">
<head>
    <meta charset="<?= Yii::$app->charset ?>
">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?>
    </title>
    <?php $this->head(); ?>

</head>
<body>
<?php $this->beginBody(); ?>

<!--header-->
<header>
    <!--    <!-- top Header -->
    <!--    <div id="top-header">-->
    <!--        <div class="container">-->
    <!--            <div class="pull-left">-->
    <!--                <span>Welcome to E-shop!</span>-->
    <!--            </div>-->
    <!--            <div class="pull-right">-->
    <!--                <ul class="header-top-links">-->
    <!--                    <li><a href="#">Store</a></li>-->
    <!--                    <li><a href="#">Newsletter</a></li>-->
    <!--                    <li><a href="#">FAQ</a></li>-->
    <!--                    <li class="dropdown default-dropdown">-->
    <!--                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">ENG <i class="fa fa-caret-down"></i></a>-->
    <!--                        <ul class="custom-menu">-->
    <!--                            <li><a href="#">English (ENG)</a></li>-->
    <!--                            <li><a href="#">Ukrainian (UA)</a></li>-->
    <!--                            <li><a href="#">Russian (Ru)</a></li>-->
    <!--                        </ul>-->
    <!--                    </li>-->
    <!--                    <li class="dropdown default-dropdown">-->
    <!--                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">USD <i class="fa fa-caret-down"></i></a>-->
    <!--                        <ul class="custom-menu">-->
    <!--                            <li><a href="#">USD ($)</a></li>-->
    <!--                            <li><a href="#">EUR (€)</a></li>-->
    <!--                            <li><a href="#">UAN (₴)</a></li>-->
    <!--                        </ul>-->
    <!--                    </li>-->
    <!--                </ul>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <!-- /top Header -->

    <!-- header -->
    <div id="header">
        <div class="container">
            <div class="pull-left">
                <!-- Logo -->
                <div class="header-logo">
                    <!--                    --><?//= Url::toRoute(['site/index', 'src' =>'@web/img/logo.png'])?>

<!--                    <a class="logo" href="">-->

                    <?php
//                    $q=;
                    echo Html::a(Html::img('@web/img/logo.png',['alt' => '']),'/',[]) ?>
<!--                        --><?php //echo Html::img('@web/img/logo.png',['alt' => '']); ?>
<!--                    </a>-->
                </div>
                <!-- /Logo -->

                <!-- Search -->
                <div class="header-search">
                    <form>
                        <input class="input search-input" type="text" placeholder="Enter your keyword">
                        <select class="input search-categories">
                            <option value="0">All Categories</option>
                            <option value="1">Category 01</option>
                            <option value="1">Category 02</option>
                        </select>
                        <button class="search-btn"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!-- /Search -->
            </div>
            <div class="pull-right">
                <ul class="header-btns">
                    <!-- Account -->
                    <li class="header-account dropdown default-dropdown">
                        <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-user-o"></i>
                            </div>
                            <strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
                        </div>
                        <?php echo Yii::$app->user->isGuest?
                            Html::a('Login', ['/site/login'], ['class'=>'text-uppercase']).'/'.Html::a('Join', ['/site/sign-up'], ['class'=>'text-uppercase']):
                            Html::a('Loged as',['site/edit-profile'],['class'=>'text-uppercase']).':'.Html::a(Yii::$app->user->identity->username, ['site/edit-profile'], ['class'=>'text-uppercase'])
                        ?>
                        <ul class="custom-menu">
                            <?php echo !Yii::$app->user->isGuest?
                                '<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
                            <li><a href="#"><i class="fa fa-heart-o"></i> My Wishlist</a></li>
                            <li><a href="#"><i class="fa fa-check"></i> Checkout</a></li>
                            <li><a href="site/logouts"><i class="fa fa-lock"></i> Log Out</a></li>':
                                '<li><a href="#"><i class="fa fa-unlock-alt"></i> Login</a></li>
                            <li><a href="#"><i class="fa fa-user-plus"></i> Join</a></li>';?>
                        </ul>
                    </li>
                    <!-- /Account -->

                    <!-- Cart -->
                    <li class="header-cart dropdown default-dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="qty">3</span>
                            </div>
                            <strong class="text-uppercase">My Cart:</strong>
                            <br>
                            <span>35.20$</span>
                        </a>
                        <div class="custom-menu">
                            <div id="shopping-cart">
                                <div class="shopping-cart-list">
                                    <div class="product product-widget">
                                        <div class="product-thumb">
                                            <?php echo Html::img('@web/img/thumb-product01.jpg',['alt' => '']); ?>
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
                                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        </div>
                                        <button class="cancel-btn"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="product product-widget">
                                        <div class="product-thumb">
                                            <?php echo Html::img('@web/img/thumb-product01.jpg',['alt' => '']); ?>
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
                                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        </div>
                                        <button class="cancel-btn"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                                <div class="shopping-cart-btns">
                                    <button class="main-btn">View Cart</button>
                                    <button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- /Cart -->

                    <!-- Mobile nav toggle-->
                    <li class="nav-toggle">
                        <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                    </li>
                    <!-- / Mobile nav toggle -->
                </ul>
            </div>
        </div>
        <!-- header -->
    </div>
    <!-- container -->
</header>
<!--/header-->

<!--content-->
<div class="wrap">
    <div class="container">
        <!--        --><?//= Breadcrumbs::widget([
        //            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        //        ]) ?>
        <?php
        if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= Yii::$app->session->getFlash('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>



        <?= $content ?>

    </div>
</div>

<!--/content-->

<!-- FOOTER -->
<footer id="footer" class="section section-grey">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- footer widget -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="footer">
                    <!-- footer logo -->
                    <div class="footer-logo">
                        <a class="logo" href="#">
                            <?php echo Html::img('@web/img/logo.png',['alt' => '']);?>
                        </a>
                    </div>
                    <!-- /footer logo -->

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>

                    <!-- footer social -->
                    <ul class="footer-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                    <!-- /footer social -->
                </div>
            </div>
            <!-- /footer widget -->

            <!-- footer widget -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="footer">
                    <h3 class="footer-header">My Account</h3>
                    <ul class="list-links">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Compare</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
            </div>
            <!-- /footer widget -->

            <div class="clearfix visible-sm visible-xs"></div>

            <!-- footer widget -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="footer">
                    <h3 class="footer-header">Customer Service</h3>
                    <ul class="list-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Shiping & Return</a></li>
                        <li><a href="#">Shiping Guide</a></li>
                        <li><?= Html::a('FAQ', ['/site/faq'])?></li>
                    </ul>
                </div>
            </div>
            <!-- /footer widget -->

            <!-- footer subscribe -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="footer">
                    <h3 class="footer-header">Stay Connected</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                    <form>
                        <div class="form-group">
                            <input class="input" placeholder="Enter Email Address">
                        </div>
                        <button class="primary-btn">Join Newslatter</button>
                    </form>
                </div>
            </div>
            <!-- /footer subscribe -->
        </div>
        <!-- /row -->
        <hr>
        <!-- row -->

        <!-- /row -->
    </div>
    <!-- /container -->
</footer>
<!-- /FOOTER -->


<?php $this->endBody(); ?>

</body>
</html>
<?php $this->endPage(); ?>
