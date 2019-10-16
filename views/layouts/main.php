<?php

/* @var $this \yii\web\View */
/* @var $this \yii\
/* @var $content string */
/* @var $product app\models\Product */
/* @var $count integer*/
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Category;
AppAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Hind:400,700');
$this->registerJsFile('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js');
$this->registerJsFile('https://oss.maxcdn.com/respond/1.4.2/respond.min.js');

if(!Yii::$app->user->isGuest)
    \app\controllers\AppController::setCart();

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <?php $this->head(); ?>

</head>
<body>
<?php $this->beginBody();?>

<!--header-->
<header>
    <!--  top Header -->
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
    <!--     /top Header -->
    <!-- header -->
    <div id="header">
        <div class="container">
            <div class="pull-left">
                <!-- Logo -->
                <div class="header-logo">
                    <?= Html::a(Html::img('@web/img/logo.png',['alt' => '']),'/',[]) ?>
                </div>
                <!-- /Logo -->

                <!-- Search -->
                <div class="header-search">
                    <form action="/goods/search" method="GET">
                        <input class="input search-input" type="text" placeholder="Enter your keyword"  name="search_param">
                        <select name="category" class="input search-categories">
                            <option value="0">
                                All categories
                            </option>
                            <?php

                        $mainCat = Category::find()->where('id = parent_id')->all();
                        foreach ($mainCat as $cat)
                            echo '<option value='.$cat->id.'">'.$cat->name.'</option>';
                        ?>
                        </select>
<!--                                                <select name="order" class="input search-categories">-->
<!--                                                    <option value="0">Price ASC</option>-->
<!--                                                    <option value="1">Price DESC</option>-->
<!--                                                    <option value="2">Name ASC</option>-->
<!--                                                    <option value="3">Name DESC</option>-->
<!--                                                </select>-->
                        <button class="search-btn"><i class="fa fa-search"></i></button>
                    </form>

                </div>
                <!--                <div class="header-search">-->
                <!--                    <select name="order" class="input search-categories">-->
                <!--                        <option href="" value="0">Price ASC</option>-->
                <!--                        <option href="" value="1">Price DESC</option>-->
                <!--                        <option href="" value="2">Name ASC</option>-->
                <!--                        <option href="" value="3">Name DESC</option>-->
                <!--                    </select>-->
                <!--                </div>-->
                <!-- /Search -->
            </div>
            <div class="pull-right">
                <ul class="header-btns">
                    <!-- Account -->
                    <li class="header-account dropdown default-dropdown" style="width: 250px overflow: hidden">
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
                                '<li><a href="/site/edit-profile"><i class="fa fa-user-o"></i> My Account</a></li>
                            <li><a href="/site/favourites"><i class="fa fa-heart"></i> Favourites</a></li>
                            <li><a href="/product/checkout"><i class="fa fa-check"></i> Checkout</a></li>
                            <li><a href="/site/logouts"><i class="fa fa-lock"></i> Log Out</a></li>':
                                '<li><a href="/site/login"><i class="fa fa-unlock-alt"></i> Login</a></li>
                            <li><a href="/site/sign-up"><i class="fa fa-user-plus"></i> Join</a></li>';?>
                        </ul>
                    </li>
                    <!-- /Account -->

                    <!-- Cart -->
                    <?php
                    if(empty($_SESSION['cartCount'])){
                                        $_SESSION['cartProducts'] = [];
                                        $_SESSION['cartSum'] = 0;
                                        $_SESSION['cartCount'] = 0;
                                    }
                                    ?>
                    <li class="header-cart dropdown default-dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="qty"><?= $_SESSION['cartCount'] ?></span>
                            </div>
                            <strong class="text-uppercase">My Cart:</strong>
                            <br>
                            <span><?= $_SESSION['cartSum'] ?>₴</span>
                        </a>
                        <div class="custom-menu">
                            <div id="shopping-cart">
                                <div class="shopping-cart-list">


                                    <?php
                                        foreach ($_SESSION['cartProducts'] as $product){
                                            ?>
                                            <div class="product product-widget">
                                                <div class="product-thumb">
                                                    <?php $image = \app\models\ProductPhoto::find()->where(['product_id' => $product->id])->one(); ?>
                                                    <?= Html::img('@web/images/product_images/'.$image->image_name,['alt' => '']); ?>
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-price"><?= round($product->price) ?>₴ <span class="qty">x<?= $product->cartQuantity ?></span>  <?= $product->cartColor ?></h3>
                                                    <h2 class="product-name"><a href="/goods/product?id=<?= $product->id ?>"><?= $product->name ?></a></h2>
                                                </div>
                                                <?php $id = Yii::$app->user->isGuest ? $product->id : $product->cartId; ?>
                                                <button class="cancel-btn"><?= Html::a('<i class="fa fa-trash">',['site/delete-from-cart?id=' .$id ])?></i></button>
                                            </div>
                                        <?php } ?>
                                    <!--                                    <div class="product product-widget">-->
                                    <!--                                        <div class="product-thumb">-->
                                    <!--                                            --><?php //echo Html::img('@web/img/thumb-product01.jpg',['alt' => '']); ?>
                                    <!--                                        </div>-->
                                    <!--                                        <div class="product-body">-->
                                    <!--                                            <h3 class="product-price">$32.50 <span class="qty">x3</span></h3>-->
                                    <!--                                            <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>-->
                                    <!--                                        </div>-->
                                    <!--
                                    <!--<!--                                        <button class="cancel-btn"><i class="fa fa-trash"></i></button>-->
                                    <!--                                    </div>-->
                                </div>
                                <div class="shopping-cart-btns">
                                    <!--                                    <button class="main-btn" onclick="window.location.href='product/site';">View Cart</button>-->
                                    <?= Html::a('<button class="primary-btn">Checkout<i class="fa fa-arrow-circle-right"></i></button>',['site/checkout']) ?>
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

<!-- NAVIGATION -->
<div id="navigation">
    <!-- container -->
    <div class="container">
        <div id="responsive-nav">
            <!-- category nav -->
            <div class="category-nav show-on-click">
                <span class="category-header">Categories <i class="fa fa-list"></i></span>
                <ul class="category-list <?= $this->params['breadcrumbs'] == 'none'? 'open' :'' ?>">
                    <?php

                    $categories = Category::find()->where('id = parent_id')->all();
                    foreach ($categories as $category)
                    {
                        if (!Category::find()->where(['parent_id' => $category->id])->andWhere(['>','id',$category->id])->exists())
                            echo '<li>'.Html::a($category->name,['/goods/category?id='.$category->id]).'</li>';
                        else {
                            ?>
                            <li class="dropdown side-dropdown">
                                <?= Html::a($category->name.'<i class="fa fa-angle-right"></i>',['/goods/category?id='.$category->id],['class' => 'dropdown-toggle' , 'data-toggle' => 'dropdown' , 'aria-expanded' => 'true']) ?>
                                <div class="custom-menu">
                                    <div class="row">

                                        <?php
                                        $level2all = Category::find()->where(['parent_id' => $category->id])->andWhere('parent_id != id')->all();
                                        foreach ($level2all as $level2) { ?>
                                        <div class="col-md-4">
                                            <ul class="list-links">
                                                <?= Html::a('<li><h3 class="list-links-title">' . $level2->name . '</h3></li>', ['/goods/category?id=' . $level2->id]) ?>
                                                <?php
                                                $level3all = Category::find()->where(['parent_id' => $level2->id])->all();
                                                foreach ($level3all as $level3) {
                                                    echo '<li>'.Html::a($level3->name,['/goods/category?id=' . $level3->id]).'</li>';
                                                }
                                                echo '</ul></div>';
                                                }

                                                ?>

                                        </div>
                                    </div>
                            </li>

                        <?php }

                    }

                    ?>
                </ul>
            </div>
            <!-- /category nav -->

            <!-- menu nav -->
            <div class="menu-nav">
                <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                <ul class="menu-list">
                    <li><?= Html::a('Home',['/']) ?></li>
                    <li><?= Html::a('Shop',['/goods/index']) ?></li>
                    <?php if (Yii::$app->user->identity && Yii::$app->user->identity->status > 1) { ?>
                    <li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Admin panel <i class="fa fa-caret-down"></i></a>
                    <ul class="custom-menu">
                        <li> <?= Html::a('Create',['/goods/create']) ?></li>
                        <li> <?= Html::a('Orders',['/admin/index']) ?></li>
                        <li> <?= Html::a('Users',['/admin/users']) ?></li>

                        </ul>
                    </li>
                    <?php } ?>
                    <li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Pages <i class="fa fa-caret-down"></i></a>
                        <ul class="custom-menu">
                            <li><?= Html::a('Home',['/']) ?></li>
                            <li><?= Html::a('Products',['/goods/index']) ?> </li>
                            <li><?= Html::a('Favourites',['/site/favourites']) ?> </li>
                            <li><?= Html::a('Checkout',['/product/checkout']) ?> </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- menu nav -->
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /NAVIGATION -->
<?php  if($this->params['breadcrumbs'] != 'none') { ?>
<!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <?php //foreach ($this->params['breadcrumbs'] as $breadcrumb) {}?>
                <?php if(isset($this->params['breadcrumbs'][0]['label'])) {
                        if(array_key_exists(1,$this->params['breadcrumbs']) && $this->params['breadcrumbs'][1]['label']) {?>
                            <li><a href="<?= $this->params['breadcrumbs'][0]['link'] ?>"><?= $this->params['breadcrumbs'][0]['label'] ?></a></li>
                        <?php } else { ?>
                            <li class="active"><?= $this->params['breadcrumbs'][0]['label'] ?>
                        <?php } ?>
                <?php } ?>
                <?php if(isset($this->params['breadcrumbs'][1]['label'])) { ?>
                    <li class="active"><?= $this->params['breadcrumbs'][1]['label'] ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
<!-- /BREADCRUMB -->
<?php } ?>
<!--content-->
<div class="wrap">
    <div class="container">
<?//= Breadcrumbs::widget([
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
                        <?= Html::a(Html::img('@web/img/logo.png',['class' => 'logo']),'/',[]) ?>
                    </div>
                    <!-- /footer logo -->

                    <p>Very usefull links if you want to waste 90% of your free-time </p>

                    <!-- footer social -->
                    <ul class="footer-social">
                        <li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a></li>
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
                        <li><?= Html::a('My Account', ['/site/edit-profile'])?></li>
                        <li><?= Html::a('Checkout', ['/product/checkout'])?></li> <!--todo:: make checkout -->
                        <li><?= Html::a('Login', ['/site/login'])?></li>
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
                        <li><?= Html::a('About', ['/site/about'])?></li>
                        <li><?= Html::a('Contacts', ['/site/contact'])?></li>
                        <li><?= Html::a('FAQ', ['/site/faq'])?></li>
                    </ul>
                </div>
            </div>
            <!-- /footer widget -->

            <!-- footer subscribe -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="footer">
                    <h3 class="footer-header">Stay Connected</h3>
                    <p>Input your email into this label to get more useless spam on it.</p>
                    <form action="site/spam">
                        <div class="form-group">
                            <input class="input" placeholder="Enter Email Address" name="email">
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
