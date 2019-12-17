<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\components\Pay;
use frontend\components\Words;

$this->title = 'Вывод средств';
$this->params['breadcrumbs'][] = ['label' => 'Финансы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .widget-pay {
        padding: 0 !important;
    }
    .label_pay {
        display: inline-block;
        position: relative;
        width: 131px;
        height: 90px;
        background-image: url(<?= Url::toRoute('/uploads/icon_payments_method.png')?>);
    }
    .visa {
        background-position: -1px -1px;
    }
    .sberbank {
        background-position: -1px -1901px;
    }
    .yandex {
        background-position: -1px -701px;
    }
    .mts {
        background-position: -1px -1601px;
    }
    .beelane {
        background-position: -1px -1701px;
    }
    .megafon {
        background-position: -1px -1801px;
    }
</style>

<div class="finance-view">

    <h1><?= Html::encode($this->title) ?></h1><br>
    <div class="col-xs-12 col-md-3 col-lg-2">
        <div class="widget-pay widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" align="center">
            <div class="label_pay <?=$method?>"></div>
        </div>
    </div>
    <div class="col-xs-12 col-md-9 col-lg-10">
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" style="text-transform: none">
            Вы выбрали выплату <?= Words::finance_method($method) ?>. Комиссия на выплату составляет <?= Pay::comission($method) ?> %. Минимальная сумма для вывода - не менее 100 рублей. Заявки обрабатываются в течение 5 рабочих дней.<br><br>

            <?php $form = ActiveForm::begin(); ?>
            <div class="col-xs-6">
                Сумма вывода
            <?= $form->field($model, 'summ')->textInput(['maxlength' => true])->label('') ?>
            </div>
            <div class="col-xs-6">
            <?= Words::finance_card_number_label($method) ?>
            <?= $form->field($model, 'card_number')->textInput(['maxlength' => true])->label('') ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Создать заявку', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>



</div>
