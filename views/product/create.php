<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 12.01.2019
 * Time: 19:55
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Create Posts';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo '<pre>';
print_r($product);
echo '</pre>';
?>
<div class="posts-create">
<!---->
<!--    'id' => 'ID',-->
<!--    'name' => 'Name',-->
<!--    'brand' => 'Brand',-->
<!--    'price' => 'Price',-->
<!--    'availability' => 'Availability',-->
<!--    'is_new' => 'Is New',-->
<!--    'discount' => 'Discount',-->
<!--    'description' => 'Description',-->
<!--    'reviews_count' => 'Reviews Count',-->
<!--    'colors' => 'Colors',-->
<!--    'photos_id' => 'Photos ID',-->
    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>

     <?= $form->field($product, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'price')->textInput(['type' => 'number']) ?>
<!---->
<!--    --><?//= $form->field($model, 'uploadFile[]')->fileInput(['multiple'=>'multiple']);?>
<!--    --><?//= $form->field($model, 'colors')->checkboxList([
//        'black' => 'black',
//        'blue' => 'blue',
//        'rose'=>'rose',
//        'gold'=>'gold',
//        'pink'=>'pink'
//    ]);
//
//    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
