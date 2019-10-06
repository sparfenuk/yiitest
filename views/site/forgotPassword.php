<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 17.01.2019
 * Time: 23:04
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Password recovery';
$this->params['breadcrumbs'][0] = ['label' => $this->title, 'link' => Yii::$app->request->url];
?>
<?php $form = ActiveForm::begin([
    'id' => 'changePassword-form',
    'options' => ['class' => 'form']
]   ); ?>
<?php
        try {
        echo $form->field($model, 'email')->textInput(['autofocus' => true])->input('email');
        }
        catch (Error $e){
            Yii::$app->session->setFlash('error', 'user with this email does not exist');
        } ?>
        <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

<?php ActiveForm::end();?>