<?php
/* @var $this \yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\User */
?>
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<!--  <script>-->
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


    $this->registerCssFile("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
    $this->registerJsFile("https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js");
    $this->registerJsFile("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");
    $this->registerJs('$(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(\'.avatar\').attr(\'src\', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on(\'change\', function(){
        readURL(this);
    });
  });');
	?>
<hr>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-3"><!--left col-->

            <?php $form = ActiveForm::begin([
                'id' => 'user_profile-form',
                'options' => ['class' => 'form']
            ]   ); ?>


      <div class="text-center">
        <br><br><br>
          <?= Html::img('@web/images/user_images/'.Yii::$app->user->identity->photo_name,
              ['class'=> 'avatar img-circle img-thumbnail','alt' => 'avatar','width' =>150  ,'height' => 150]) ?>
<!--        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">-->
          <?= $form->field($model,'image')->label('avatar')->fileInput(['accept' => '.jpg,.png']) ?>
      </div><br>







        </div><!--/col-3-->
    	<div class="col-sm-9">



          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>




                      <div class="form-group">
                          
                          <div class="col-xs-6">

                              <?= $form->field($model, 'username')
                                  ->textInput(['autofocus' => true,'class' => 'form-control', 'id' => 'username','value' => Yii::$app->user->identity->username ?? 'no-username']) ?>
<!--                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">-->
                          </div>
                      </div>
<!--                      <div class="form-group">-->
<!--                          -->
<!--                          <div class="col-xs-6">-->
<!--                            <label for="last_name"><h4>Last name</h4></label>-->
<!--                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">-->
<!--                          </div>-->
<!--                      </div>-->
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <?= $form->field($model, 'mobile_number')
                                  ->textInput(['class' => 'form-control', 'id' => 'mobile_number','value' => Yii::$app->user->identity->mobile_number ??]) ?>
<!--                              <label for="phone"><h4>Phone</h4></label>-->
<!--                              <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">-->
                          </div>
                      </div>
          
<!--                      <div class="form-group">-->
<!--                          <div class="col-xs-6">-->
<!--                             <label for="mobile"><h4>Mobile</h4></label>-->
<!--                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any.">-->
<!--                          </div>-->
<!--                      </div>-->
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <?= $form->field($model, 'email')
                                  ->input('email',['class' => 'form-control', 'id' => 'email','value' => Yii::$app->user->identity->emailch ?? 'no-email']) ?>
<!--                              <label for="email"><h4>Email</h4></label>-->
<!--                              <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">-->
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <?= $form->field($model, 'location')->textInput(['class' => 'form-control', 'id' => 'location','value' => Yii::$app->user->identity->location ?? 'no-location']) ?>
<!--                              <label for="email"><h4>Location</h4></label>-->
<!--                              <input type="email" class="form-control" id="location" placeholder="somewhere" title="enter a location">-->
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <?= $form->field($model, 'password')
                                  ->input('password',['class' => 'form-control', 'id' => 'password','value' => '']) ?>
<!--                              <label for="password"><h4>Password</h4></label>-->
<!--                              <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">-->
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <?= $form->field($model, 'password2')
                                  ->input('password',['class' => 'form-control', 'id' => 'password2','value' => '']) ?>
<!--                            <label for="password2"><h4>Verify</h4></label>-->
<!--                              <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">-->
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                      </div>
                      <?php ActiveForm::end() ?>

              
              <hr>
              



        </div><!--/col-9-->
          </div>
        </div>
    </div>
</div>