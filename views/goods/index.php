<?php

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
use yii\widgets\LinkPager;
use app\models\Category;
use yii\widgets\Pjax;

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;



    ?>





                 <div id="main" class="col-md-12"  >

                     <div id="store">



                             <?php
                             foreach ($products as $key=>$value) {

                                 if ($value !== null) {

                                     $curl = Url::toRoute(['goods/category', 'id' => Category::getCategoryId($key)]);

                                     echo '
                   <div class="col-md-12">
					<div class="section-title">
					<a href="' . $curl . '">
						<h2 class="title">' . $key . '</h2>
					</a>
					</div>
					        
                               <div class = "row">';

                                     foreach ($value as $goods) {
                                         $url = Url::toRoute(['goods/product', 'id' => $goods->id]);
                                         $name = ProductPhoto::find()->where(['product_id' => $goods->id])->one();

                                           ?>
                                        <div class="col-md-4 col-sm-6 col-xs-6">
                                            <div class="product product-single">
                                               <div class="product-thumb" >
                                                <div class="product-label">
                                                    <?php
                                                    $d = $goods->getDiscount();
                                                    if ($d!==null)
                                                    {
                                                        echo '<span class="sale">-'.$d.'%</span>';

                                                    }
                                                    else if($goods->isNew())
                                                    {
                                                        echo '	<span>New</span>';
                                                    }
                                                    ?>

                                                </div>

                                                 <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                                 <img style = "width: 100%;" src="<?=Yii::$app->params['basePath'] . '/images/product_images/' . HTML::encode($name->image_name)?>" >

                                               </div>

                                               <div class="product-body">

                                                   <h3 class="product-price"> <?=round($goods->price)?>
                                                       <?php

                                                       if($goods->prev_price != 0)
                                                       {
                                                           echo'<del class="product-old-price">'.round($goods->prev_price).'</del>';

                                                       }


                                                       ?>

                                                   </h3>

                                                   <div class="product-rating">
                                                       <?php
                                                       for( $i = 0; $i < 5 ;$i++)
                                                       {
                                                           if ($i<$goods->getAverageMark())
                                                           {
                                                               echo '<i class="fa fa-star"></i>';
                                                           }
                                                           else
                                                               echo '<i class="fa fa-star-o empty"></i>';

                                                       }
                                                       ?>


                                                   </div>

                                                   <h2 class="product-name">
                                                       <a href="<?= $url ?>"><?= $goods->name ?></a>
                                                   </h2>
                                                   <div class="product-btns">
                                                       <?= Html::a('<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>',['/site/add-to-favourites?id='.$goods->id]); ?>


                                                       <?= Html::a('<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Cart</button>',['/site/add-to-cart', 'productId' => $goods->id]); ?>

                                                   </div>
                                                   <?php


             if ($goods->availability <= 0) {
                 echo 'Out of stock';

             }
             else if(Yii::$app->user->identity->status >= 2)
             {


                 // goods/update?id=1
                 echo '<form method="get" action="/goods/update">
               <input type="hidden" name="id" value="'.$goods->id.'">
                <button type="submit">Update</button>
               </form>';
             }
             ?>
                                               </div>
                                            </div>
                                         </div>
                         <?php
                                     }
                                     echo '</div>';
                                 }
                             }


                              ?>



                     </div>

             </div>




