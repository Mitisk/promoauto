<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\AutoMark;
use common\models\AutoModel;

$this->title = 'Автомобили';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
   .auto-image {
        max-width: 242px;
        height: 141px;
   }
</style>
<?php if ($myautos) { ?>
    <h3 class="page-title"><?= Html::encode($this->title) ?>&nbsp;&nbsp;<?php if ($myautos) {echo Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp; Добавить', ['create'], ['class' => 'btn btn-default']).' '.Html::a('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp; Поиск', ['search'], ['class' => 'btn btn-default']);} ?></h3>
    <div class="row">
    <?php foreach ($myautos as $myauto) {
        $fullnameauto = AutoMark::findOne($myauto->auto_mark_id)->name . ' ' . AutoModel::findOne($myauto->auto_model_id)->name;
        ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="thumbnail ">
                    <div class="auto-image">
                        <img src="<?= \frontend\widgets\Auto::widget(['Auto_file_name' => $myauto->auto_id]) ?>" alt="<?= AutoMark::findOne($myauto->auto_mark_id)->name; ?> <?= AutoModel::findOne($myauto->auto_model_id)->name; ?>" width="100%" class="">
                    </div>
                    <div class="caption">
                        <h3 align="center"><a href="<?= Url::to(['autos/view?id='.$myauto->auto_id])?>"><?= $fullnameauto; ?></a></h3>
                        <? if(!$myauto->auto_occupied) {?>
                            <div align="center">
                        <span class="label label-default"><?= Yii::$app->formatter->asDate($myauto->auto_date, 'dd-MM-yyyy') ?></span>
                        <?php if($myauto->auto_confirmed) {?><span class="label label-info">проверен</span><?php } ?>
                        <?php if($myauto->auto_vip) {?><span class="label label-warning">vip</span><?php } ?>
                            </div>
                        <? } else {?><div align="center"><span class="label label-danger">Идет рекламная кампания</span></div><? } ?>
                        <p align="right">
                            <a href="<?= Url::to(['autos/update?id='.$myauto->auto_id])?>" class="btn btn-default tooltips <?php if($myauto->auto_occupied) {?> disabled<?php } ?>" data-original-title="Редактировать" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
        <?php if(!$myauto->auto_vip) {?><a class="btn green tooltips <?php if($myauto->auto_occupied) {?> disabled<?php } ?>" data-original-title="Поднять в списке" data-toggle="modal" href="#basic-<?= $myauto->auto_id ?>" role="button"><i class="fa fa-arrow-up" aria-hidden="true"></i></a><? } ?>
                            <a href="<?= Url::to(['autos/delete?id='.$myauto->auto_id])?>" data-method="post" class="btn btn-danger tooltips <?php if($myauto->auto_occupied) {?> disabled<?php } ?>" data-original-title="Удалить" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </p>
                    </div>
                </div>
            </div>
        <?php if(!$myauto->auto_vip) {?>
        <div class="modal fade" id="basic-<?= $myauto->auto_id ?>" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background: url(/../uploads/img/popup-bg-vip.png);">
                    <div class="modal-header" style="border-bottom: none;color: wheat;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h1 class="modal-title" align="center"><b> VIP</b></h1><h4 class="modal-title" align="center" style="margin-top: -13px;">статус</h4>
                    </div>
                    <div class="modal-body" style="background: #faf3c1;margin: 0 20px 0 20px;">
                        <div class="col-xs-3" style="padding-left: 0;">
                            <? if (file_exists('/uploads/auto/'.$myauto->auto_image)) {?>
                                <img src="/uploads/auto/<?= $myauto->auto_id ?>/small_<?= $myauto->auto_image ?>" alt="<?= AutoMark::findOne($myauto->auto_mark_id)->name; ?> <?= AutoModel::findOne($myauto->auto_model_id)->name; ?>" width="100%">
                            <?} else {?>
                                <img src="/uploads/auto/no.png" alt="<?= AutoMark::findOne($myauto->auto_mark_id)->name; ?> <?= AutoModel::findOne($myauto->auto_model_id)->name; ?>" width="100%">
                            <?}?>
                        </div>
                        <div class="col-xs-7" style="padding-left: 0;">
                            <h3 style="margin-top: 0;"><?= $fullnameauto; ?></h3>
                            <i class="fa fa-check" aria-hidden="true"></i> поднятие в поиске <br>
                            <i class="fa fa-check" aria-hidden="true"></i> больше предложений <br>
                            <i class="fa fa-check" aria-hidden="true"></i> выделение в списках <br>
                        </div>
                        <div class="col-xs-2" style="background: rgb(206, 185, 102);padding: 10px 0 10px 0;" align="center">
                            <h3 style="margin-top: 0;">20</h3>
                            бонусов
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-body" style="background-color: #faf3c1;margin: 20px;" align="center">
                        <? if (Yii::$app->user->identity->bonus > 19) {?>
                        У Вас <?= Yii::$app->user->identity->bonus ?> бонусов
                        <?} else {?>
                            У Вас недостаточно бонусов для покупки
                        <?}?>
                    </div>
                    <div class="modal-footer" style="border-top: none;margin: -10px 5px 0 5px;" align="center">
        <? if (Yii::$app->user->identity->bonus > 19) {?>
                        <a type="button" class="btn blue btn-block">Покупка</a>
        <?} else {?>
                        <a type="button" class="btn white btn-outline btn-block" data-dismiss="modal">Закрыть</a>
        <?}?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php }} echo '</div>';} else { ?>
    <div class="row" style="background: url(uploads/img/auto.jpg) round; background-repeat: no-repeat; margin: -19px -20px -10px -20px; height: 80vh;">
        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1" align="center">
            <br><br class="hidden-sm"><br class="hidden-sm hidden-md">
            <div style="border: dashed 1px; color: #ffffff;">
            <H1>Вы не добавили автомобилей</H1>
            <H3>Попробуйте, это просто!</H3><br>
            <?=Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> ДОБАВИТЬ', ['create'], ['class' => 'btn white btn-outline sbold uppercase']);?>
            <br><br>
            </div>
        </div>
    </div>
    <?php } ?>
