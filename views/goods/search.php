<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 12.02.2019
 * Time: 16:37
 */

use yii\helpers\Html;
use app\models\ProductPhoto;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = 'Search';
$this->params['breadcrumbs'][0] = ['label' => $this->title, 'link' => Yii::$app->request->url];

?>
<div class="col-md-12">
    <div class="section-title">
        <h2 class="title">Results for "<?= $search_param ?>"</h2>
        <div class="pull-right">
            <h3 class="title"> Order by: </h3>

            <ul class="order-by" >
                <li>  <?= $sort->link('name') ?>  </li>
                <li>  <?= $sort->link('price') ?>   </li>

            </ul>


        </div>
    </div>
</div>




<div class="container">
    <div class="row">
        <?php foreach ($dataProvider->models as $product) {
            echo $this->render('@app/views/base/single_product', [
                'product' => $product,
            ]);
        } ?>
        <div class="col-md-12">
            <?= LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
        </div>
    </div>
</div>

