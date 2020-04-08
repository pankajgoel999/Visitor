<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = "User Registration";
/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-form">
zsdfasd
    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-12">
        <h5 class="pagetitle">asdfasdf<?=Yii::t('yii', $this->title)?></h5>
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
    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'personal_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'personal_country')->textInput() ?>

    <?= $form->field($model, 'personal_state')->textInput() ?>

    <?= $form->field($model, 'personal_district')->textInput() ?>

    <?= $form->field($model, 'personal_city')->textInput() ?>

    <?= $form->field($model, 'personal_pin')->textInput() ?>

    <?= $form->field($model, 'official_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'official_country')->textInput() ?>

    <?= $form->field($model, 'official_state')->textInput() ?>

    <?= $form->field($model, 'official_district')->textInput() ?>

    <?= $form->field($model, 'official_city')->textInput() ?>

    <?= $form->field($model, 'official_pin')->textInput() ?>

    <?= $form->field($model, 'id_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'personal_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
