<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
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
<div class="col-md-12"><h1><?= Html::encode($this->title) ?> </h1></div>
<div class="col-md-3">
    <div class="portlet light">
        <div class="portlet-title">

                <?= Html::a('<i class="fa fa-plus"></i> Написать', ['create'], ['class' => 'btn red-sunglo btn-block']) ?>

        </div>
        <div class="portlet-body">
            <div class="scroller" style="height:50vh;" data-start="bottom" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
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
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-speech font-green-sharp"></i>
                <span class="caption-subject"> Сообщения</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                    <i class="icon-trash"></i>
                </a>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="scroller" style="height:50vh;" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                <h4>Heading Text</h4>
                <p>   <? foreach ($messages as $mess) { ?>
                        <?= $mess->from_user_id ?>
                        <?= $mess->text ?>

                    <? } ?><br><br>

                    <? foreach ($names as $name) {
                        $arr = array_unique ($name);
                        print (array($arr).'<br>');
                    } ?>


                </p>
            </div>
        </div>
    </div>
</div>

    </div>
















