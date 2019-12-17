<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рекламные кампании';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .campaign {
        padding: 10px;
    }
    .campaign:hover {
        cursor: pointer;
        background-color: #F6F6F6;
    }
    .campaignlink {
        text-decoration: none !important;
        color: #333;
    }
    .old {
        line-height: initial;
    }
</style>

<? if ($campaigns) {?>
    <h3 class="page-title"><?= Html::encode($this->title) ?>&nbsp;&nbsp; <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>', ['create'], ['class' => 'btn btn-success']) ?></h3>
    <? foreach ($campaigns as $campaign) {?>
        <div class="col-md-6">
        <a href="<?= Url::to(['campaign/view?id='.$campaign->id])?>" class="campaignlink">
        <div class="panel panel-info panel-body campaign">
            <h6 style="margin: 0"><span class="label label-default"> id <?=$campaign->id?> </span>&nbsp;&nbsp;
            <span class="label label-default"> <?= Yii::$app->formatter->asDate($campaign->datetime, 'dd-MM-yyyy') ?> </span></h6>
        <br>
        <h4 style="margin: 0"><b>
                <?= \yii\helpers\StringHelper::truncate($campaign->name,45,'...');?>
        </b></h4>
            <p style="margin-top: 0">Баланс: <?= Yii::$app->formatter->asDecimal($campaign->balance) ?> р.</p>
        </div>
        </a>
        </div>
    <?}?>
<?} if (!$campaigns and $oldcampaigns) {?>
        <div class="panel panel-info">
            <div class="panel-body page-title" align="center" style="min-height: 100px">
                <p>Скорее запустите еще одну рекламную кампанию!</p>
                <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> НАЧАТЬ', ['create'], ['class' => 'btn blue-hoki btn-outline sbold uppercase']) ?>
            </div>
        </div>
<?}?>
<? if ($oldcampaigns) { ?>
    <div class="col-xs-12"><hr><h3>Прошедшие рекламные кампании</h3><br></div>
    <? foreach ($oldcampaigns as $oldcampaign) {?>
        <div class="col-md-12">
            <a href="<?= Url::to(['campaign/view?id='.$oldcampaign->id])?>" class="campaignlink">
            <div class="panel panel-info panel-body campaign">
                <h6 style="margin: 0"><span class="label label-default"> id <?=$oldcampaign->id?> </span>&nbsp;&nbsp;
                    <span class="label label-default"> <?= Yii::$app->formatter->asDate($oldcampaign->datetime, 'dd-MM-yyyy') ?> </span>
                    <b class="old">
                        &nbsp;&nbsp;<?= Html::encode($oldcampaign->name) ?>
                    </b></h6>
            </div>
            </a>
        </div>
    <?}?>
<?}?>
<? if (!$campaigns and !$oldcampaigns) {?>
    <div class="panel panel-info">
        <div class="panel-body page-title" align="center" style="min-height: 300px"><br>
            <i class="fa fa-bar-chart"></i><br>
            <p>Вашу первую рекламную кампанию создать и запустить очень просто!</p>
            <?= Html::a('<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> НАЧАТЬ', ['create', 'campaing' => 'new'], ['class' => 'btn blue-hoki btn-outline sbold uppercase']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> ПОМОЩЬ', ['/support'], ['class' => 'btn blue-hoki btn-outline sbold uppercase']) ?>
        </div>
    </div>
<?}?>

