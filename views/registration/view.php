<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'fname',
            'lname',
            'mobile',
            'email:email',
            'personal_address:ntext',
            'personal_country',
            'personal_state',
            'personal_district',
            'personal_city',
            'personal_pin',
            'official_address:ntext',
            'official_country',
            'official_state',
            'official_district',
            'official_city',
            'official_pin',
            'id_type',
            'id_number',
            'id_file',
            'personal_photo',
            'date_modified',
        ],
    ]) ?>

</div>
