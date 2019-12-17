<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Купоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-9">
    <?if ($model->vip == 1) {?>
        <h1><?= $this->title ?></h1>
    <?} else {?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?}?>
</div>
<div class="col-md-3">
    <?if (Yii::$app->user->id == $model->user_id) {?>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот купон?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?}?>
</div>
<div class="clearfix"></div>
<div class="col-md-2" align="center">
    <h1 class="font-red-flamingo">
    <? if ($model->size) {?>
        - <?= $model->size ?><? } else {?>
        <i class="fa fa-gift" style="font-size: 50pt;" aria-hidden="true"></i>
    <?}?></h1><br>
        до <?= $model->date ?>

</div>
<div class="col-md-10">
    <? if ($model->vip) { ?>  <span class="badge badge-warning badge-roundless"> VIP </span> <?}?>
    <? if ($model->recommend) { ?><span class="badge badge-primary badge-roundless"> рекомендуем </span><?}?>
    <? if (!$model->visible) { ?><span class="badge badge-default badge-roundless"> на модерации </span><?}?><br>
    <?if ($model->vip == 1) {?>
        <?= $model->text ?>
    <?} else {?>
        <?= Html::encode($model->text) ?>
    <?}?><br><br>
    <? if ($model->code) { ?>Ваш персональный промо-код: <?= $model->code ?><br><br><?}?>
    <?if ($model->address) {?><a href="<?= $model->address ?>" class="btn btn-info">Перейти по ссылке</a><br><?}?>
</div>

