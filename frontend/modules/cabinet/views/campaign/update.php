<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Campaign */

$this->title = 'Редактировать кампанию: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Рекламные кампании', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="campaign-update">

    <h1 align="center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
