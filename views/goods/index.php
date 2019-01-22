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


$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;

    echo '
                   <div class="col-md-12">
					<div class="section-title">
						<h2 class="title">here should be name of category</h2>
						<div class="pull-right">
						   <h3 class="title"> Order by: </h3>
						    <ul style="float: right; margin-top: 12px;" >
								<li>'.$sort->link('name').'</li>
								<li>'.$sort->link('price').'</li>
							
					    </ul>
                        
					 
					  </div>
					</div>
				</div>
               ';


     //var_dump($dataProvider);
echo  '<div class = "row">';

    foreach  ($dataProvider->models as $goods) {
        $url = Url::toRoute( [ 'goods/product', 'id' => $goods->id] );
        $name = ProductPhoto::find()->where(['product_id' => $goods->id])->one();;

        echo  '<div class = "col-md-3 col-sm-6 col-xs-6">';
        echo  '<div class = "product product-single">';




        echo  '<div class = "product-thumbbbb">
           <a href='.HTML::encode($url).'>
             <img style = "width: 200px;" src="' . Yii::$app->params['basePath'] . '/images/'. HTML::encode($name->image_name).'" > 
            </a>
             </div>';

        echo  '<div class = "product-body">'
            .'<div class="name">'
              .'<a  href='.HTML::encode($url).'>' .HTML::encode($goods->name) .'</a>'
            .'</div>'
              .'<div class="product-price">' . HTML::encode($goods->price)
              .'</div>'
            .'</div>';
          if ($goods->availability <= 0)
          {
              echo 'Out of stock';

          }

        echo '</div>'.'</div>';
    }
    echo LinkPager::widget(['pagination' =>  $dataProvider->pagination]);
echo '</div>';

 ?>




