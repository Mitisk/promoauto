<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Autos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Autos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'auto_id',
            'auto_user_id',
            'auto_location_id',
            'auto_date',
            'auto_image',
            // 'auto_price',
            // 'auto_price_for',
            // 'auto_type',
            // 'auto_view',
            // 'auto_mark_id',
            // 'auto_model_id',
            // 'auto_year',
            // 'auto_city',
            // 'auto_color',
            // 'auto_damage',
            // 'auto_parking:ntext',
            // 'auto_comment:ntext',
            // 'auto_confirmed',
            // 'auto_occupied',
            // 'auto_vip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
