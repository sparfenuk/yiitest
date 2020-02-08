<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductAuction */

$this->title = 'Create Product for Auction';
$this->params['breadcrumbs'][] = ['label' => 'Product Auctions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-auction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model) ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'start_price')
        ->textInput([
        'type' => 'number'
       ]) ?>
    <?= $form->field($model, 'description') ?>
    <?= $form->field($model, 'date_end')->input(['type' => 'datetime-local']) ?>
    <?= $form->field($uploader, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <?= $form->field($model, 'category_id')->dropDownList($categories)?>
    <?= Html::submitButton('Create') ?>
    <?php ActiveForm::end(); ?>

</div>
