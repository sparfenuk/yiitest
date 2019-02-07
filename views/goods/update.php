<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 22.01.2019
 * Time: 20:52
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Update product information';
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="posts-update">
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

    <?= $form->field($product, 'brand')->textInput(['maxlength' => true]) ?>

     <?= $form->field($product, 'description')->textarea(['rows' => '6']) ?>

    <?= $form->field($product, 'price')->textInput(['type' => 'number']) ?>

    <?= $form->field($categories, 'name')->dropdownList(
        Category::find()->select(['name', 'id'])->indexBy('id')->column() )->label("Category")?>


    <?= $form->field($uploader, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($product, 'colors')->checkboxList([
        'black' => 'black',
        'blue' => 'blue',
        'rose'=>'rose',
        'gold'=>'gold',
        'pink'=>'pink'
    ]);

    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>