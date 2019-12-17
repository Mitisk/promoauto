<?php
use yii\helpers\Html;
use common\models\AutoAdvertPlace;
use common\models\Autos;
use common\models\AutoMark;
use common\models\AutoModel;
use yii\widgets\ActiveForm;
use frontend\components\Words;
use frontend\components\Func;

/* @var $this yii\web\View */
/* @var $model common\models\Campaign */

$this->title = \yii\helpers\StringHelper::truncate($model->name,70,'...');
$this->params['breadcrumbs'][] = ['label' => 'Рекламные кампании', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-xs-12 col-md-9">
    <h1><?= Html::encode($this->title) ?></h1>
    <h5><?= Words::campaignstatus($model->status) ?></h5>
</div>
<? if ($model->status == 0) {?>
<div class="col-xs-12 col-md-3" align="right">
    <p>
        <?= Html::a('Редактировать', [$model->tariff_plan, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
<?}?>
<div class="col-xs-12">
    <p style="margin: 0">Баланс: <?= Yii::$app->formatter->asDecimal($model->balance) ?> р.
        (<a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">пополнить</a><? if ($model->balance >= '1') { if ($model->status != '1') {?> | <?= Html::a('вернуть на счет', ['bank', 'id' => $model->id, 'operation' => 'refund'], ['data' => ['method' => 'post']]); }}?>)</p>
    <div class="collapse col-xs-12 col-md-4" id="collapseExample">
        <div class="well" style="margin-top: 20px">
            У Вас на счету <?= Yii::$app->formatter->asDecimal($money) ?> рублей.
            <h5 style="margin-top: 0px; font-size: 10px;">Рекомендуемая сумма пополнения в месяц - <?= $recommendsumm?> рублей, минимум - 50 рублей.</h5>
            <div align="center">
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['bank', 'id' => $model->id],
                ]); ?>
                <div class="input-group">
                    <?= Html::textInput('balance',"",['class' => 'form-control', 'id'=>'downloadSourceCode']); ?>
                    <span class="input-group-btn">
                        <?= Html::submitButton('Пополнить', ['class' => 'btn blue']) ?>
                    </span>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<div class="clearfix"></div>
    <p style="margin-top: 0">Заблокировано: <?= Yii::$app->formatter->asDecimal($model->blocked_balance) ?> р.<br>
    Потрачено: <?= Yii::$app->formatter->asDecimal($model->spend_balance) ?> р.</p>

    <?if ($campaignplaces) {?>
    <div class="row" style="margin: 0;">
        <div class="panel panel-info panel-body bg-grey-steel" style="padding: 0">
            <div class="portlet light bg-grey-steel" style="padding: 0 20px 0;">
                <p>
                    Стоимость изготовления и рассылки <? Words::admaterial($campaignplacescount)?> на выбранные рекламные площадки составляет <?= Func::campaignprice($campaignplacescount, $model->tariff_plan) ?> рублей <span class="font-green-jungle">(заблокировано)</span>.
                </p>
            </div>
        </div>
        <? foreach($campaignplaces as $campaignplace) {
            $autoplase = AutoAdvertPlace::findOne($campaignplace->auto_advert_place_id);
            $auto = Autos::findOne($autoplase->auto_id);
            ?>
                <div class="panel panel-info panel-body" style="padding: 0">
                    <div class="col-xs-3 col-md-2" style="margin: 2px; padding-left: 0px;"><img src="<?= \frontend\widgets\Auto::widget(['Auto_file_name' => $autoplase->auto_id]) ?>" width="100%"></div>
                    <div class="col-xs-9 col-md-10" style="margin-left: -4px;">
                        <div class="portlet light" style="padding: 12px 0px 0px; margin-bottom: 0px;">
                            <div class="portlet-title" style="margin-bottom: 0px;">
                                <div class="caption">
                                    <span class="caption-subject bold uppercase"> <?= AutoMark::findOne($auto->auto_mark_id)->name; ?> <?= AutoModel::findOne($auto->auto_model_id)->name; ?></span>
                                    <span class="caption-helper"><?= Words::placestatus($autoplase->status)?></span>
                                </div>
                                <div class="actions">
                                    <label class="btn btn-circle btn-transparent grey-salsa">
                                        <? if (!$campaignplace->datetime_run) {
                                            echo Yii::$app->formatter->asDate($campaignplace->datetime, 'dd.MM.yyyy');
                                        } else {
                                            echo Yii::$app->formatter->asDate($campaignplace->datetime_run, 'dd.MM.yyyy');
                                        }
                                         ?>
                                    </label>
                                    <?= Html::a('<i class="icon-wrench"></i>',
                                        ['campaignplace/view', 'id' => $campaignplace->id, 'from' => $model->id],
                                        ['class' => 'btn btn-circle btn-icon-only btn-default',
                                            'data' => [
                                                'method' => 'post',
                                            ]
                                        ]) ?>

                                    <? if ($autoplase->status == '0' or $autoplase->status == '1' or $autoplase->status == NULL) {
                                        echo Html::a('<i class="icon-trash"></i>',
                                        ['campaignplace/delete', 'id' => $campaignplace->id, 'from' => $model->id],
                                        ['class' => 'btn btn-circle btn-icon-only red-sunglo',
                                            'data' => [
                                                'method' => 'post',
                                            ]
                                        ]);
                                    } ?>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <p style="margin: 0;">
                                    <?= $autoplase->price ?> рублей <?= Words::priceforrus($autoplase->price_for) ?><br>
                                    <?= $campaignplace->datetime_run ? Yii::$app->formatter->asDate($campaignplace->datetime_run, 'dd.MM.yyyy') : NULL; ?>
                                    <?= $campaignplace->datetime_end ? ' - '.Yii::$app->formatter->asDate($campaignplace->datetime_end, 'dd.MM.yyyy') : NULL; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        <?}?>
    </div>
    <?}?>
    </div>
    <div class="col-xs-12">
        <? if ($model->status == '0' and $campaignplacescount > 0 and $model->balance >= Func::campaignprice($campaignplacescount, $model->tariff_plan)) {
            echo Html::a('<i class="fa fa-play" aria-hidden="true"></i> Запустить рекламную кампанию', ['run', 'id' => $model->id], ['class' => 'btn blue btn-block btn-outline ']);
        } if ($model->status == '0') {
            echo Html::a('<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Найти рекламные площадки&nbsp;&nbsp;&nbsp;&nbsp; ', ['autos/search'], ['class' => 'btn green btn-block btn-outline']);
        }

        ?>
        <br>
    </div>



