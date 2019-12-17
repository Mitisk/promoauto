<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Autos */

$this->title = 'Добавление автомобиля';
$this->params['breadcrumbs'][] = ['label' => 'Автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .font-grey-cascade {
        color: #fff!important;
    }
    </style>
<div class="row" style="background: url(/uploads/img/bg-add.jpg) round; margin: -19px -20px -10px -20px; ">
    <div class="mt-element-step">
        <div class="row step-line">
            <div class="col-md-4 mt-step-col first done">
                <div class="mt-step-number bg-white">1</div>
                <div class="mt-step-title uppercase font-grey-cascade">Описание</div>
                <div class="mt-step-content font-grey-cascade">автомобиля</div>
            </div>
            <div class="col-md-4 mt-step-col ">
                <div class="mt-step-number bg-white">2</div>
                <div class="mt-step-title uppercase font-grey-cascade">Реклама</div>
                <div class="mt-step-content font-grey-cascade">стоимость и размещение</div>
            </div>
            <div class="col-md-4 mt-step-col last">
                <div class="mt-step-number bg-white">3</div>
                <div class="mt-step-title uppercase font-grey-cascade">Фотографии</div>
                <div class="mt-step-content font-grey-cascade">загрузка фотографий</div>
            </div>
        </div>
    </div>


    <div class="col-xs-12" align="center">
        <br>
        <div style="background-color: rgba(55,57,68,.9); color: #ffffff;">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        </div>
    </div>
</div>

