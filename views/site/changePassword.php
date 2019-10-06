<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 18.01.2019
 * Time: 0:00
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change password';
$this->params['breadcrumbs'][0] = ['label' => $this->title, 'link' => Yii::$app->request->url];
?>
<?php $form = ActiveForm::begin([
    'id' => 'changePassword-form',
    'options' => ['class' => 'form']
]   ); ?>
<?php
try {
    echo $form->field($model, 'password')->input('password',['value'=>'']);
}
catch (\yii\base\ErrorException $e){
    $this->goHome();
} ?>
<?= $form->field($model, 'password2')->input('password',['value'=>'']) ?>

<?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

<?php ActiveForm::end();?>