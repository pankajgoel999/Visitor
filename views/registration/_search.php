<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'fname') ?>

    <?= $form->field($model, 'lname') ?>

    <?= $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'personal_address') ?>

    <?php // echo $form->field($model, 'personal_country') ?>

    <?php // echo $form->field($model, 'personal_state') ?>

    <?php // echo $form->field($model, 'personal_district') ?>

    <?php // echo $form->field($model, 'personal_city') ?>

    <?php // echo $form->field($model, 'personal_pin') ?>

    <?php // echo $form->field($model, 'official_address') ?>

    <?php // echo $form->field($model, 'official_country') ?>

    <?php // echo $form->field($model, 'official_state') ?>

    <?php // echo $form->field($model, 'official_district') ?>

    <?php // echo $form->field($model, 'official_city') ?>

    <?php // echo $form->field($model, 'official_pin') ?>

    <?php // echo $form->field($model, 'id_type') ?>

    <?php // echo $form->field($model, 'id_number') ?>

    <?php // echo $form->field($model, 'id_file') ?>

    <?php // echo $form->field($model, 'personal_photo') ?>

    <?php // echo $form->field($model, 'date_modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
