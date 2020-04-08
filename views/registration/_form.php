<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = "User Registration";

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    select, textarea, input{
        box-shadow: 2px 2px 2px  #a3f2c6 ;
    }
</style>
<div id="example1">
  <p></p>
</div>
<div class="user-profile-form container">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-12">
        <h5 class="pagetitle"><?=Yii::t('yii', $this->title)?></h5>
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            if(!empty($message)){
                echo "<br><div class='text-center alert alert-$key'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span></button> <b>$message</b>
                </div>";
            }
        }
        ?>
        <span id="display_error" style="display:none;">
            <div class="col-sm-12 text-center">
                <div class="alert alert-danger" role="alert">
                  <span id="display_error_message"></span>
                </div>
            </div>
        </span>
    </div>
    <div class="col-sm-12">
        <div class="innertitle"><?=Yii::t('yii', 'Basic Details')?>:-</div>
    </div>
    </div>
    <div class="col-sm-8">
        <div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'fname')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('fname'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
     
    <div class="col-sm-6">
        <?= $form->field($model, 'lname')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('lname'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
    </div>
        <div class="row">
     <div class="col-sm-6">
        <?= $form->field($model, 'mobile')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('mobile'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
    
     <div class="col-sm-6">
        <?= $form->field($model, 'email')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('email'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
            </div>
    </div>
    
    <div class="col-sm-4">
    

    <?= $form->field($model, 'personal_photo')->textInput(['maxlength' => true]) ?>

    
    </div>
    <div class="row">
    <div class="col-sm-12">
        <div class="innertitle"><?=Yii::t('yii', 'Personal Address Details')?>:-</div>
    </div>
        
    </div>
    <div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'personal_address')->textarea([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('personal_address'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
    
    <div class="col-sm-4">
        <?= $form->field($model, 'personal_country')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('personal_country'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
 
     <div class="col-sm-4">
        <?= $form->field($model, 'personal_state')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('personal_state'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
    </div>
    <div class="row">
     <div class="col-sm-4">
        <?= $form->field($model, 'personal_district')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('personal_district'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'personal_city')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('personal_district'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
    
    <div class="col-sm-4">
        <?= $form->field($model, 'personal_pin')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('personal_pin'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
    </div>
  <div class="row">
        <div class="col-sm-12">
            <div class="innertitle"><?=Yii::t('yii', 'Official Address Details')?>:-</div>
        </div>
   </div>

    <div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'official_address')->textarea([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('official_address'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
        
    <div class="col-sm-4">
        <?= $form->field($model, 'official_country')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('official_country'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
        
    <div class="col-sm-4">
        <?= $form->field($model, 'official_state')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('official_state'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
        
    </div>   
    
    <div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'official_district')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('official_address'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
        
    <div class="col-sm-4">
        <?= $form->field($model, 'official_city')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('official_country'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
        
    <div class="col-sm-4">
        <?= $form->field($model, 'official_pin')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('official_state'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
        
    </div>  

     <div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'id_type')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('id_type'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
         
    <div class="col-sm-4">
        <?= $form->field($model, 'id_number')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('id_number'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
         
    <div class="col-sm-4">
        <?= $form->field($model, 'id_file')->textInput([ 'class'=>'form-control form-control-sm', 'placeholder'=>$model->getAttributeLabel('id_file'), 'autofocus' => true, 'autocomplete'=>'off']) ?>
    </div>
         
    </div>     

    <div class="col-sm-12"><hr></div>
     <div class="row">
    <div class="col-sm-3">
        
   
        <label>Enter Captcha</label>
        <input type="text" class="form-control form-control-sm" required="" name="Registration[captcha]" id="regd_captcha" placeholder="Enter Captcha" maxlength="5"  autocomplete="off" />
    </div>
         <div class="col-sm-1"></div>
    <div class="col-sm-4">
        <div style="padding-top: 15px;">
            <img src="<?php echo Yii::$app->homeUrl; ?>internals/captcha_image.php" alt="" id="registrationcaptcha" />
            <img src="<?php echo Yii::$app->homeUrl; ?>images/refresh.jpg" width="25" alt="" id="registrationrefresh" title="Click to refresh captcha image" />
        </div>
    </div>
         <div class="col-sm-4">
        <br>
        <button type="button" class="btn btn-success btn-sm" id="regbtn">Submit</button>
        <button type="reset" class="btn btn-danger btn-sm">Reset</button>
        <br><br><br><br>
    </div>
    </div>
     

    <?php ActiveForm::end(); ?>

</div>
