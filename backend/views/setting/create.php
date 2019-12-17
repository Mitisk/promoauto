<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Autos */

$this->title = 'Создание значения настроек';
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
