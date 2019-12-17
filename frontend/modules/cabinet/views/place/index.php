<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auto Advert Places';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auto-advert-place-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Auto Advert Place', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'auto_id',
            'side',
            'place',
            'price',
            // 'price_for',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
