<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\AutoMark;
use common\models\AutoModel;
use frontend\components\Words;

/* @var $this yii\web\View */
/* @var $model common\models\Autos */

$this->title = AutoMark::findOne($model->auto_mark_id)->name . ' ' . AutoModel::findOne($model->auto_model_id)->name;
$this->params['breadcrumbs'][] = ['label' => 'Автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->request->get('id');
$color = Words::auto_color($model->auto_color);
?>
<style type="text/css">
    small:before {
        content: normal !important;
    }
</style>
<div class="col-md-7">

    <h1><?= Html::encode($this->title) ?></h1>
</div>
<?if($autouserid==Yii::$app->user->id){?>
<div class="col-md-5" align="right">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->auto_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->auto_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
<?} else {
    echo '<div class="clearfix"></div>';
} if($model->auto_confirmed==0){?>
<div class="col-md-12">
    <div class="note note-warning">
        <h4 class="block" style="padding: 0px">Этот автомобиль находится на проверке</h4>
        <p>Данный автомобиль не принимает участие в поиске, так как еще не был проверен. Если проверка затянулась, обратитесь в
            <a href="<?=Url::to(['support/create', 'mess'=>'Долгая проверка автомобиля с идентификатором id'.$model->auto_id.'.']);?>">поддержку</a>.</p>
    </div>
</div>
<?}?>
<div class="col-lg-3">
    <div class="mt-element-ribbon" style="padding:0">
        <?if($model->auto_vip==1){?>
        <div class="ribbon ribbon-shadow ribbon-vertical-right ribbon-color-warning uppercase">
            <i class="fa fa-star"></i>
        </div>
        <?}?>
        <img src="<?= \frontend\widgets\Auto::widget(['Auto_file_name' => $model->auto_id]) ?>" alt="<?= AutoMark::findOne($model->auto_mark_id)->name; ?> <?= AutoModel::findOne($model->auto_model_id)->name; ?>" width="100%" class="">
    </div>
</div>
<div class="col-lg-9">
        <div class="col-sm-9">
            <span class="label label-default"><?= Yii::$app->formatter->asDate($model->auto_date, 'dd-MM-yyyy') ?></span>
            <?php if($model->auto_confirmed) {?><span class="label label-info">проверен</span><?php } ?>
            <?php if($model->auto_vip) {?><span class="label label-warning">vip</span><?php } ?>
            <? if($model->auto_occupied) {?><span class="label label-danger">Идет рекламная кампания</span><? } ?>
        </div>
        <div class="col-sm-3" align="right">
            <img src="/uploads/img/<?= $model->auto_type ?>.png" style="height: 30px;transform: scale(-1, 1);">
        </div><br><hr>
    <i class="text-muted">Владелец:</i> <?= $autousername ?><br>
    <i class="text-muted">Год выпуска автомобиля:</i> <?= $model->auto_year ?><br>
    <i class="text-muted">Город:</i> <?= $model->auto_city ?><br>
    <i class="text-muted">Цвет кузова:</i> <?= $color ?><br>
    <? if($model->auto_damage){?><i class="text-warning"> Автомобиль имеет видимые повреждения кузова. </i><br><? } ?><br>
    <blockquote><small class="text-muted">Место парковки:</small><?= $model->auto_parking ?></blockquote>
    <blockquote><small class="text-muted">Комментарий водителя:</small><?= $model->auto_comment ?></blockquote>
</div>
<div class="row">

    <? if ($model->auto_type) {
        echo $this->render('_g' . $model->auto_type, [
            'model' => $model,
            'id' => $id,
            'view' => 'view',
            'modelview' => $model->auto_view,
            'querycampaign' => $querycampaign,
            'campaignscount' => $campaignscount
        ]);
    }?>
</div>
