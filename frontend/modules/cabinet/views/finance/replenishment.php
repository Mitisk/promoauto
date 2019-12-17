<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\components\Pay;
use frontend\components\Words;

$this->title = 'Пополнить баланс';
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
        <div class="widget-pay widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" style="text-transform: none">
            <div style="margin: 5px">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'summ')->textInput(['maxlength' => true])->label('Сумма пополнения') ?>
                <?= Html::submitButton('Создать заявку', ['class' => 'btn btn-success btn-block']) ?>
            </div>
        <?php ActiveForm::end(); ?>
        </div>

    </div>
    <div class="col-xs-12 col-md-9 col-lg-10">
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray" style="text-transform: none">


        <? if ($method == 'visa') { ?>
        <? } elseif ($method == 'sberbank') { ?>
            Для пополнения счета через "Сбербанк Онлайн" необходимо перейти в раздел "Переводы и платежи", выбрать пункт "Перевод клиенту Сбе​р​б​а​нка".<br>
            Номер карты получателя: 4276440015584839<br>
            В сообщении укажите: id<?= Yii::$app->user->id ?><br><br>
            <a href="javascript:;" class="thumbnail">
                <img src="<?= Url::toRoute('/uploads/sber.png') ?>">
            </a>
            После проделанных действий заполните форму слева. Деньги поступят на счет в течение суток.<br><br>

        <? } elseif ($method == 'yandex') { ?>

        <? } else {echo 'КРИТИЧЕСКАЯ ОШИБКА';} ?>

        </div>
    </div>



</div>
