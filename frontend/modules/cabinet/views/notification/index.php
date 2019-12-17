<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Уведомления';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="page-title font-blue-steel" style="margin-top: -1px;"><i class="fa fa-bell"></i> <?= Html::encode($this->title) ?></h3>

<?
foreach ($notifications as $notify) :
    ?>
    <hr>
    <div class="row">
        <div class="col-md-1" align="center">
            <?if ($notify->active) {?>
            <a href="<?= Url::toRoute($notify->url)?>" class="btn btn-icon-only green-jungle">
                <span class="label label-sm label-icon label-<?=$notify->type?>">
                <i class="fa fa-<?=$notify->icon?>"></i>
                </span>
            </a>
            <?} else {?>
                <a href="<?= Url::toRoute($notify->url)?>" class="btn btn-icon-only grey-cararra">
                    <i class="fa fa-<?=$notify->icon?>"></i>
                </a>
            <?}?>
        </div>
        <div class="col-md-9">
            <a href="<?= Url::toRoute($notify->url)?>">
                <h4 style="margin-top: -10px;"><?=$notify->name?></h4>
            </a>
            <p style="margin: -5px 0;"><?=$notify->text?></p>
        </div>
        <div class="col-md-2" align="center"><span class="time"><?=$notify->date?></span></div>
    </div>
    <?
endforeach;
?><hr>
<div align="center">
<?= LinkPager::widget([
    'pagination' => $pages,
]);
?>
    </div>

