<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Autos */

$this->title = $model->auto_id;
$this->params['breadcrumbs'][] = ['label' => 'Autos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->auto_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->auto_id], [
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
            'auto_id',
            'auto_user_id',
            'auto_location_id',
            'auto_date',
            'auto_image',
            'auto_price',
            'auto_price_for',
            'auto_type',
            'auto_view',
            'auto_mark_id',
            'auto_model_id',
            'auto_year',
            'auto_city',
            'auto_color',
            'auto_damage',
            'auto_parking:ntext',
            'auto_comment:ntext',
            'auto_confirmed',
            'auto_occupied',
            'auto_vip',
        ],
    ]) ?>

</div>
