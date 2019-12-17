<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Campaign */

$this->title = 'Новая кампания';
$this->params['breadcrumbs'][] = ['label' => 'Рекламные кампании', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1 align="center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tariff1_price' => $tariff1_price,
        'tariff2_price' => $tariff2_price,
        'tariff3_price' => $tariff3_price,
    ]) ?>