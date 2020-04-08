<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'fname',
            'lname',
            'mobile',
            //'email:email',
            //'personal_address:ntext',
            //'personal_country',
            //'personal_state',
            //'personal_district',
            //'personal_city',
            //'personal_pin',
            //'official_address:ntext',
            //'official_country',
            //'official_state',
            //'official_district',
            //'official_city',
            //'official_pin',
            //'id_type',
            //'id_number',
            //'id_file',
            //'personal_photo',
            //'date_modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
