<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Autos */

$this->title = 'Редактирование автомобиля: ' . $model->auto_id;
$this->params['breadcrumbs'][] = ['label' => 'Автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->auto_model, 'url' => ['view', 'id' => $model->auto_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="autos-update">

    <h3 class="page-title">><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
