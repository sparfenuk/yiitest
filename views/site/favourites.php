<?php
/**
 */
use yii\helpers\Html;

$this->title = 'Favourites';
$this->params['breadcrumbs'][0] = ['label' => $this->title, 'link' => Yii::$app->request->url];


if ($favourites != null): ?>
    <div class="row">
        <!-- section title -->
        <div class="col-md-12">
            <div class="section-title">
                <h2 class="title">Favourites</h2>
            </div>
        </div>
        <!-- section title -->
<?php
    foreach ($favourites as $favourite):
        $product = \app\models\Product::find()->where(['id' => $favourite->product_id])->one();
        echo $this->render('@app/views/base/single_product', [
            'product' => $product,
        ]);
    endforeach;
endif;
?>