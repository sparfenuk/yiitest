<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-error">
        <?= Yii::$app->session->getFlash('error'); ?>
    </div>
    <?php if (Yii::$app->session->hasFlash('success')): ?>

        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success'); ?>
        </div>


    <?php else: ?>


        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'signUp-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->input('text') ?>

                <?= $form->field($model, 'email')->input('email') ?>

                <?= $form->field($model, 'password')->input('password') ?>

                <?= $form->field($model, 'password_confirm')->input('password') ?>

                <?= $form->field($model, 'mobile number')->input('number') ?>

                <?= $form->field($model, 'country')->input('text') ?>



                <!--                    --><? //= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                //                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                //                    ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
