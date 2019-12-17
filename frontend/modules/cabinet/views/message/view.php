<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = 'Диалог';
$this->params['breadcrumbs'][] = ['label' => 'Сообщения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    .inbox-contacts{margin:0 -15px 30px;padding:0;list-style:none}
    .inbox-contacts>li {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .inbox-contacts>li>a {
        position: relative;
        display: block;
        padding: 8px 16px;
        color: #3f444a;
        text-decoration: none;
    }
    .inbox-contacts>li>a .contact-pic {
        width: 30px;
        height: 30px;
        border-radius: 50%!important;
    }
    .inbox-contacts>li>a .contact-name {
        display: inline-block;
        padding-left: 5px;
    }
    .inbox-contacts>li>a:hover{background:#f1f4f7;text-decoration:none}
</style>

<div class="row" style="height: 75vh;">
    <div class="col-md-3">
        <div class="portlet light">
            <div class="portlet-title">

                <?= Html::a('<i class="fa fa-plus"></i> Написать', ['create'], ['class' => 'btn red-sunglo btn-block']) ?>

            </div>
            <div class="portlet-body">
                <div class="scroller" style="height:50vh;" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                    <ul class="inbox-contacts">
                        <? foreach ($messages as $mess) {

                            $fromuser = \common\models\User::findOne($mess->from_user_id);
                            ?>
                            <li>
                                <a href="<?= Url::toRoute('/cabinet/message/view?from='.$fromuser->id.'&id='.$mess->id)?>">
                                    <?
                                    $filename = 'uploads/users/avatar/usr_' . $fromuser->id;
                                    $filename2 = 'uploads/users/avatar/usr_' . $fromuser->id . '.png';
                                    if (file_exists($filename.'.jpg')) {
                                        echo '<img src="/../../'.$filename.'.jpg" class="contact-pic">';
                                    } elseif (file_exists($filename.'.png')) {
                                        echo '<img src="/../../'.$filename.'.png" class="contact-pic">';
                                    } else {
                                        echo '<img src="/../../uploads/users/avatar/no-ava.png" class="contact-pic">';
                                    }
                                    ?>
                                    <span class="contact-name"> <?php if ($fromuser->name) {echo $fromuser->name;} else {echo $fromuser->username;} ?></span>
                                </a>

                            </li>
                        <? }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="portlet light" style="margin-bottom: -10px;">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject"> Сообщения</span>
                </div>
                <div class="actions">
                    <?=Html::a('<i class="icon-trash"></i>', ['delete', 'from' => Yii::$app->request->get('from')], [
            'class' => 'btn btn-circle btn-icon-only btn-default',
            'data' => [
                'confirm' => 'Будет удален весь диалог. Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                </div>
            </div>

            <div class="portlet-body">
                <div class="scroller" style="height:50vh;" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                    <div class="timeline">
                        <? foreach ($messages as $mess) {
                            $fromuser = \common\models\User::findOne($mess->from_user_id);
                            if($mess->to_user_id != Yii::$app->user->id && $mess->from_user_id == Yii::$app->user->id && $mess->from_del == '0'){
                                $notdel = true;
                            } elseif($mess->to_user_id == Yii::$app->user->id && $mess->from_user_id != Yii::$app->user->id && $mess->to_del == '0'){
                                $notdel = true;
                            } else {$notdel = false;}
                            if ($notdel){
                            ?>
                        <div class="timeline-item">
                            <div class="timeline-badge">
                                <?
                                $filename = 'uploads/users/avatar/usr_' . $fromuser->id;
                                $filename2 = 'uploads/users/avatar/usr_' . $fromuser->id . '.png';
                                if (file_exists($filename.'.jpg')) {
                                    echo '<img src="/../../'.$filename.'.jpg" class="timeline-badge-userpic">';
                                } elseif (file_exists($filename.'.png')) {
                                    echo '<img src="/../../'.$filename.'.png" class="timeline-badge-userpic">';
                                } else {
                                    echo '<img src="/../../uploads/users/avatar/no-ava.png" class="timeline-badge-userpic">';
                                }
                                ?></div>
                            <div class="timeline-body">
                                <div class="timeline-body-arrow"> </div>
                                <div class="timeline-body-head">
                                    <div class="timeline-body-head-caption">
                                        <a href="javascript:;" class="timeline-body-title font-blue-madison">
                                            <?php if ($fromuser->name) {echo $fromuser->name.' '.$fromuser->middlename;} else {echo $fromuser->username;} ?></a>
                                        <span class="timeline-body-time font-grey-cascade"><?= Yii::$app->formatter->asDatetime($mess->date, $format = short) ?></span>
                                    </div>
                                    <div align="right">
                                    <? if ($mess->from_user_id != Yii::$app->user->id) {?>
                                        <? if ($mess->report != '1') {?>
                                        <a href="<?= Url::toRoute('/cabinet/message/spam?from='.$mess->from_user_id.'&id='.$mess->id)?>" style="text-decoration: none; font-size: 9pt; color: #95A5A6!important;">это спам </a>
                                        <?}else{?>
                                        <span style="font-size: 9pt; color: red;">Вы пометили как спам </span>
                                        <?}?>
                                    <?}?>
                                    <a href="<?= Url::toRoute('/cabinet/message/delete?id='.$mess->id)?>" data-method="post" style="text-decoration: none; font-size: 9pt; color: #95A5A6!important;"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </div>
                                    </div>
                                <div class="timeline-body-content">
                                    <span class="font-grey-cascade">
                                        <?= Html::encode($mess->text) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?}}?>
                    </div>

                </div>
            </div>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-sm-10">
        <div class="form-group form-md-line-input form-md-floating-label">
            <textarea id="message-text" class="form-control" name="Message[text]" rows="2" style="resize: none;"></textarea>
            <label for="form_control_1">Введите Ваше сообщение...</label>
            <?= $form->field($model, 'to_user_id')->hiddenInput(['value' => $_GET['from']])->label(false) ?>
        </div>
        </div>
        <div class="col-sm-2" align="right">
            <?= Html::submitButton('<i class="fa fa-pencil" aria-hidden="true"></i>', ['class' => 'btn green-haze btn-outline sbold uppercase']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>


