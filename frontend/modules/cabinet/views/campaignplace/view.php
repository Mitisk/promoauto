<?php
use yii\helpers\Html;
use frontend\components\Words;
/* @var $this yii\web\View */
/* @var $model common\models\CampaignPlace */

$this->params['breadcrumbs'][] = 'Рекламное место';
?>
<style type="text/css">
    .datetime {
        border: 1px solid #c2cad8;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #eef1f5;
        width: 100%;
        float: left;
    }
    .datetimeicon {
        background-color: #e1e5ec;
        width: 40px;
        float: left;
        padding: 10px;
        margin: -10px;
    }
    .datetimetext {
        padding-left: 35px;
    }
    .fa-calendar {
        padding-left: 4px;
    }
</style>

<? if ($auto->auto_user_id == Yii::$app->user->id) { //Если на страницу зашел владелец автомобиля ?>
    <? if ($aaplace->status == '2') { //Если отправлено на утверждение водителем ?>
    <div class="col-sm-12">
        <div class="note note-danger">
            <h4 class="block">Это рекламное место хотят взять в аренду.</h4>
            <p>
                Рекламодатель ожидает Вашего одобрения. Он хочет включить это рекламное место в свою рекламную кампанию.
            </p><br>
            <p>
                <?= Html::a('Я согласен',
                    ['campaignplace/answer', 'id' => $model->auto_advert_place_id, 'answer' => 'yes', 'from' => $model->id],
                    ['class' => 'btn blue',
                        'data' => [
                            'method' => 'post',
                        ]
                    ]) ?>
                <?= Html::a('Я не согласен',
                    ['campaignplace/answer', 'id' => $model->auto_advert_place_id, 'answer' => 'no', 'from' => $model->id],
                    ['class' => 'btn red',
                        'data' => [
                            'method' => 'post',
                        ]
                    ]) ?>
            </p>
        </div>
    </div>
    <? } ?>
<? } ?>




<div class="col-md-4 col-xs-12">
<img src="<?= \frontend\widgets\Auto::widget(['Auto_file_name' => $auto->auto_id]) ?>" width="100%">
</div>
<div class="col-md-4 col-xs-12">
    <h1 style="margin-top: 0px;"><?=$autoname?></h1><h5><?= Words::placestatus($aaplace->status) ?></h5>

    <div class="datetime">
        <div class="datetimeicon"><i class="fa fa-calendar"></i></div>
        <div class="datetimetext">
    <? if (!$model->datetime_run) {
        echo Yii::$app->formatter->asDate($model->datetime, 'dd.MM.yyyy');
    } else {
        echo Yii::$app->formatter->asDate($model->datetime_run, 'dd.MM.yyyy');
    }
    ?>
    <?= $model->datetime_end ? ' - '.Yii::$app->formatter->asDate($model->datetime_end, 'dd.MM.yyyy') : '' ?>
        </div>
    </div>
    <div class="datetime">
        <div class="datetimeicon" align="center"><i class="fa fa-rub"></i></div>
        <div class="datetimetext">
            <?= $aaplace->price ?> рублей <?= Words::priceforrus($aaplace->price_for) ?>
        </div>
    </div>
</div>
<div class="col-md-4 col-xs-12">
    <? if ($campaign->user_id == Yii::$app->user->id) { //Если на страницу зашел рекламодатель
    if ($aaplace->status == '3' OR $aaplace->status ==  '4') { ?>
        Сделать запрос:
        <? if (!$task1) {
            echo Html::a('Фото рекламной конструкции',
            ['task/advertising-photo', 'campaignplaceid' => $model->id],
            ['class' => 'btn blue btn-block',
                'data' => [
                    'method' => 'post',
                ]
            ]);
        } else { echo Html::a('Фото рекламной конструкции', ['campaign/index'], ['class' => 'btn blue btn-block', 'disabled' => 'disabled']);}
        if (!$task2) {
            echo Html::a('Фото спидометра',
            ['task/speedometer-photo', 'campaignplaceid' => $model->id],
            ['class' => 'btn blue btn-block',
                'data' => [
                    'method' => 'post',
                ]
            ]);
        } else { echo Html::a('Фото спидометра', ['campaign/index'], ['class' => 'btn blue btn-block', 'disabled' => 'disabled']);}
        if (!$task3) {
            echo Html::a('Помыть машину (300 руб.)',
                ['task/wash-car', 'campaignplaceid' => $model->id],
                ['class' => 'btn blue btn-block',
                    'data' => [
                        'method' => 'post',
                    ]
                ]);
        } else { echo Html::a('Помыть машину', ['campaign/index'], ['class' => 'btn blue btn-block', 'disabled' => 'disabled']);}
        ?>

    <? } } ?>
</div>
<div class="clearfix"></div>
<div class="col-xs-12 col-md-6">
    <? if ($auto->auto_type) {
    echo $this->render('/autos\_g' . $auto->auto_type, [
    'view' => 'campaign',
    'side' => $aaplace->side,
    'point' => $aaplace->point,
    'modelview' => $auto->auto_view,
    ]);
    }?>
</div>
<div class="col-xs-12 col-md-6">
    Содержание объявления:
    &laquo<?= $campaign->text ?>&raquo
    Планируемый срок размещения:
    <? Words::campaign_period($campaign->period) ?>
</div>


<?if ($tasks) {?>
<div class="col-xs-12">
    <hr>
    <H2>Задания:</H2>
    <div class="table-scrollable table-scrollable-borderless">
        <table class="table table-hover table-light">
            <tbody>
    <? foreach ($tasks as $task) {?>
                <tr <? if (!$task->status) {echo 'class="warning"';}?>>
                    <td><?=$task->name?></td>

                    <td>
                        <? echo Yii::$app->formatter->asDatetime($task->date, "php:d.m.Y H:i");?>
                    </td>
                    <td align="right">
                        <? if ($campaign->user_id == Yii::$app->user->id) {
                            if (!$task->status) {
                                echo Html::a('Жалоба', ['support/create', 'mess' => 'Авовладелец не выполняет свои обязательства. Идентификатор ' . $model->id], ['class' => 'btn blue']);
                            }
                        } else {
                            if ($task->status == '0') {
                                echo Html::a('Начать', ['task/to-begin', 'id' => $task->id, 'campaignplaceid' => $model->id], ['class' => 'btn blue']);
                            } elseif ($task->status == '1') {
                                echo Html::a('Загрузить', ['task/confirmation', 'id' => $task->id, 'campaignplaceid' => $model->id], ['class' => 'btn blue']);
                            }
                        }
                        if ($task->view == '10') {
                            echo Html::a('Смотреть', ['task/view', 'id' => $task->id], ['class' => 'btn blue']);
                        }
                        if ($campaign->user_id == Yii::$app->user->id and $task->status == '1') {
                            echo '<span class="label label-info"><i class="fa fa-spinner" aria-hidden="true"></i> в работе </span>';
                        }
                        if ($campaign->user_id == Yii::$app->user->id and $task->status == '2') {
                            echo '<span class="label label-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i> выполнено </span>';
                        }
                        ?>
                    </td>
                </tr>
    <?}?>
            </tbody>
        </table>
    </div>
</div>
<?}?>
