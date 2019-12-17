<?php
use yii\helpers\Html;
use frontend\components\Words;
use yii\helpers\Url;
use frontend\components\Pay;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Финансы';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .widget-pay {
        padding: 0 !important;
        cursor: pointer;
    }
    .widget-pay:hover {
        border: 1px solid #0090c5;
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
    .promo {
        background-position: -1px -1098px;

    }
    .promo_back {
        background: linear-gradient(to top, #b60d14, #d52e35);

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

<div class="row">

<div class="col-md-4">
    <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray">
            <h4 class="widget-thumb-heading">Баланс</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green fa fa-rub"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">РУБ</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= Yii::$app->formatter->asDecimal(Yii::$app->user->identity->balance, $decimals = null) ?>">
                        <b><?= Yii::$app->formatter->asDecimal(Yii::$app->user->identity->balance, $decimals = null) ?> &#8381;</b>
                    </span>
                </div>
            </div>
        </div>
    <!-- END WIDGET THUMB -->
</div>
<div class="col-md-4">
    <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray">
            <h4 class="widget-thumb-heading">Баланс в ожидании</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-grey fa fa-rub"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">РУБ</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= Yii::$app->formatter->asInteger(Yii::$app->user->identity->blocked_balance) ?>"><?= Yii::$app->formatter->asDecimal(Yii::$app->user->identity->blocked_balance, $decimals = null) ?> &#8381;</span>
                </div>
            </div>
        </div>
    <!-- END WIDGET THUMB -->
</div>
<div class="col-md-4">
    <!-- BEGIN WIDGET THUMB -->
    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray">
        <h4 class="widget-thumb-heading">Бонусный баланс</h4>
        <div class="widget-thumb-wrap">
            <i class="fa fa-gift widget-thumb-icon bg-red" aria-hidden="true"></i>
            <div class="widget-thumb-body">
                <span class="widget-thumb-subtitle">БОН</span>
                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= Yii::$app->formatter->asInteger(Yii::$app->user->identity->bonus) ?>">
                    <?= Yii::$app->formatter->asInteger(Yii::$app->user->identity->bonus) ?>
                </span>
            </div>
        </div>
    </div>
    <!-- END WIDGET THUMB -->
</div>
<div class="col-xs-12"><h2>Пополнить баланс</h2></div>

    <? Pay::visa('replenishment') ?>
    <? Pay::sberbank('replenishment') ?>
    <? Pay::yandex('replenishment') ?>

    <a data-toggle="modal" href="#basic">
        <? Pay::promo('promo') ?>
    </a>
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin: 10px !important;"></button>
                    <div class="promo_back widget-thumb widget-bg-color-white text-uppercase bordered hover-gray" align="center">
                        <div class="label_pay promo"></div>
                    </div>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => ['promo'],
                    ]); ?>
                    <div class="input-group">
                        <?= Html::textInput('promocode',"",['class' => 'form-control', 'id'=>'downloadSourceCode']); ?>
                        <span class="input-group-btn">
                        <?= Html::submitButton('Применить', ['class' => 'btn blue']) ?>
                    </span>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<div class="clearfix"></div>

    <div class="col-xs-12"><h2>Вывод средств</h2></div>

    <? Pay::mts('withdrawal') ?>
    <? Pay::beelane('withdrawal') ?>
    <? Pay::megafon('withdrawal') ?>
    <? Pay::visa('withdrawal') ?>
    <? Pay::sberbank('withdrawal') ?>
    <? Pay::yandex('withdrawal') ?>

    <div class="col-xs-12"><h2>История операций</h2></div>
    <div class="col-xs-12">
    <table class="table table-hover table-light">
        <thead>
        <tr class="uppercase">
            <th>  </th>
            <th> Сумма </th>
            <th> Метод </th>
            <th> Дата </th>
            <th> Статус </th>
        </tr>
        </thead>
        <tbody>
            <? foreach ($history as $item) {?>
                <tr <?if ($item->action == 'withdrawal') {echo 'class="danger"';}?>>
                    <td> <? Words::finance_action($item->action)?> <? if ($item->promo) {echo '&laquo;'.$item->promo.'&raquo;';}?> </td>
                    <td> <?= $item->summ?> руб </td>
                    <td> <?= $item->method?> </td>
                    <td> <?= Yii::$app->formatter->asDate($item->date, 'dd-MM-yyyy') ?> </td>
                    <td> <? Words::finance_result($item->result) ?> </td>
                </tr>
            <?}?>
        </tbody>
    </table>
        <div align="center">
        <?echo LinkPager::widget([
            'pagination' => $pages,
        ]);?>
        </div>
    </div>
</div>