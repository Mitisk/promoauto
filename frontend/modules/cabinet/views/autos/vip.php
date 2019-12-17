<?php
use common\models\AutoMark;
use common\models\AutoModel;
?>

<div class="row" style="background: url(/../uploads/img/pr-bg.png); margin: -19px -20px -10px -20px; height: 80vh;">
    <div class="col-md-3"></div>
    <div class="col-md-6" style="background-color: #000077">
<?= AutoMark::findOne($model->auto_mark_id)->name; ?> <?= AutoModel::findOne($model->auto_model_id)->name; ?>

        <a class="btn red btn-outline sbold" data-toggle="modal" href="#basic"> View Demo </a>
        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
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
                            <h3 style="margin-top: 0;"><?= AutoMark::findOne($model->auto_mark_id)->name; ?> <?= AutoModel::findOne($model->auto_model_id)->name; ?></h3>
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
                    <div class="modal-footer" style="border-top: none" align="center">
                        <button type="button" class="btn green">Покупка</button>
                        <button type="button" class="btn white btn-outline" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <div class="col-md-3"></div>
</div>



