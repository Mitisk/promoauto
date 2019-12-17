<?php
use yii\helpers\Url;
$this->title = 'Промоавто - реклама на автомобилях в Новосибирске';
$this->params['breadcrumbs'][] = 'Кабинет пользователя';
?>
<link href="/../layout/css/themes/profile.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .hover-gray:hover {
        cursor: pointer;
        background-color: #F6F6F6;
    }
    .hover-shadow:hover {
        box-shadow: 3px 5px 7px 0px #c0c0c0;
    }
    .hover-bonus {
        text-align: center;
        margin: 1px 11px 1px 1px;
        padding: 2px 0px 0px 10px;
    }
    .hover-bonus:hover {
        text-align: center;
        background-color: #f6f9fb;
        border: dashed 1px #efefef;
        margin: 0px 10px 0px 0px;
        padding: 2px 0px 0px 10px;
        text-decoration: none;
        cursor: pointer;
    }
    .hover-bonus-gift i {
        visibility: hidden;
        width: 0%;
        float: left;
    }
    .hover-bonus-gift:hover i {
        visibility: visible;
        font-size: 3em;
        margin-top: 25px;
    }
    .hover-bonus-gift p {
        margin: 0;
    }
    .hover-bonus-gift:hover p {
        margin-left: 25px;
    }
</style>

<?=$this->render("profileSidebar") ?>
<!-- BEGIN PROFILE CONTENT -->



<div class="profile-content">
    <?if (Yii::$app->user->identity->role != 'рекламодатель' && !$autocount) {?>
    <div class="col-md-12">
        <div class="alert alert-block alert-success fade in" style="margin-top: 15px;background-image: url(/../uploads/img/back.png); height: 40px; color: #ffdf7d">
            <div class="col-xs-9" align="left">
                <p style="margin: -7px;"><i class="fa fa-car" aria-hidden="true"></i>  Добавьте свой автомобиль и начните зарабатывать.</p>
            </div>
            <div class="col-xs-3" align="center">
                <a href="<?= Url::toRoute('/cabinet/autos/create')?>" class="btn yellow-lemon btn-outline" style="margin-top: -14px;line-height: 0.9;"> добавить </a>
                <button type="button" class="close" data-dismiss="alert" style="opacity: 0.8;">x</button>
            </div>
        </div>
    </div>
    <?}?>
    <div class="col-md-6">
        <!-- BEGIN WIDGET THUMB -->
        <a href="<?= Url::toRoute('/finance')?>" style="text-decoration: none">
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray">
            <h4 class="widget-thumb-heading">Баланс</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green fa fa-rub"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">РУБ</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= Yii::$app->formatter->asDecimal($user->identity->balance, $decimals = null) ?>">
                        <b><?= Yii::$app->formatter->asDecimal($user->identity->balance, $decimals = null) ?> &#8381;</b>
                    </span>
                </div>
            </div>
        </div>
        </a>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-6">
        <!-- BEGIN WIDGET THUMB -->
        <a href="<?= Url::toRoute('/finance')?>" style="text-decoration: none">
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered hover-gray">
            <h4 class="widget-thumb-heading">Баланс в ожидании</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-grey fa fa-rub"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">РУБ</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= Yii::$app->formatter->asInteger($user->identity->blocked_balance) ?>"><?= Yii::$app->formatter->asDecimal($user->identity->blocked_balance, $decimals = null) ?> &#8381;</span>
                </div>
            </div>
        </div>
        </a>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-12">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Бонусная статистика</h4>
            <div class="widget-thumb-wrap">
                <a data-toggle="modal"  data-target=".aw1"><i class="widget-thumb-icon <?if (!$aword1) {?>bg-default<?}else{?>bg-blue-sharp<?}?> fa fa-pencil hover-shadow"></i></a>
                <?if ($user->identity->role == 'рекламодатель') {?>
                <a data-toggle="modal"  data-target=".aw3"><i class="widget-thumb-icon <?if (!$aword3) {?>bg-default<?}else{?>bg-red<?}?> fa fa-bar-chart hover-shadow"></i></a>
                <?}else{?>
                    <a data-toggle="modal"  data-target=".aw2"><i class="widget-thumb-icon <?if (!$aword2) {?>bg-default<?}else{?>bg-red<?}?> fa fa-car hover-shadow"></i></a>
                <?}?>
                <a data-toggle="modal"  data-target=".aw4"><i class="widget-thumb-icon <?if (!$aword4) {?>bg-default<?}else{?>bg-purple-wisteria<?}?> fa fa-credit-card hover-shadow"></i></a>
                <a data-toggle="modal"  data-target=".aw5"><i class="widget-thumb-icon <?if (!$aword5) {?>bg-default<?}else{?>bg-yellow-saffron<?}?> fa fa-shopping-cart hover-shadow"></i></a>
                <a data-toggle="modal"  data-target=".aw6"><i class="widget-thumb-icon <?if (!$aword6) {?>bg-default<?}else{?>bg-yellow-casablanca<?}?> fa fa-arrow-up hover-shadow"></i></a>
                <a data-toggle="modal"  data-target=".aw7"><i class="widget-thumb-icon <?if (!$aword7) {?>bg-default<?}else{?>bg-green-jungle<?}?> fa fa-check hover-shadow"></i></a>
                <i class="widget-thumb-icon fa fa-plus" style="color: #8e9daa;"></i>
                <a href="<?= Url::toRoute('/finance')?>" style="text-decoration: none">
                <div class="widget-thumb-body hover-bonus hover-bonus-gift">
                    <i class="fa fa-gift alignnone font-purple-medium" aria-hidden="true"></i>
                    <p><span class="widget-thumb-subtitle">Бонусы</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= Yii::$app->formatter->asInteger($user->identity->bonus) ?>"><?= Yii::$app->formatter->asInteger($user->identity->bonus) ?></span></p>
                </div>
                </a>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">обо мне</h4>
            <div style="text-transform:none">
                <div class="row static-info">
                    <div class="col-md-5 name"> Имя: </div>
                    <div class="col-md-7 value"> <?= ($user->identity->name ? $user->identity->name.' '.$user->identity->middlename.' '.$user->identity->surname : 'Не указано')?> </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name"> Email: </div>
                    <div class="col-md-7 value"> <?= $user->identity->email ?> </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-5 name"> Телефон: </div>
                    <div class="col-md-7 value"> <?= $user->identity->phone ?> </div>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <?php if ($user->identity->addres) { ?>
        <div class="col-md-6 col-sm-12">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">адрес</h4>
                <div style="text-transform:none">
                    <div class="row static-info">
                        <div class="col-md-12 value">
                            <?= $user->identity->addres ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
    <?php } ?>
</div>
<!-- END PROFILE CONTENT -->

<!-- BEGIN MODAL -->
<div class="modal fade aw1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div align="center" style="margin: 20px;">
                <img src="/../uploads/img/reward/<?if (!$aword1) {?>no<?}?>1.png" width="150px"><br><br>
                Очень важно, чтобы у Вас было заполнено как можно больше нформации о себе, поэтому, Вы получите эту награду при полном заполнении своего профиля.

            </div>
        </div>
    </div>
</div>
<?if ($user->identity->role == 'рекламодатель') {?>
    <div class="modal fade aw3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div align="center" style="margin: 20px;">
                    <img src="/../uploads/img/reward/<?if (!$aword3) {?>no<?}?>3.png" width="150px"><br><br>
                    Точно в цель! За Вашу первую рекламную кампанию! Надеемся, что было легко!
                </div>
            </div>
        </div>
    </div>
<?}else{?>
    <div class="modal fade aw2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div align="center" style="margin: 20px;">
                    <img  src="/../uploads/img/reward/<?if (!$aword2) {?>no<?}?>2.png" width="150px"><br><br>
                    Награда выдается за добавление своего первого автомобиля, а также 5 бонусных баллов в придачу.
                </div>
            </div>
        </div>
    </div>
<?}?>
<div class="modal fade aw4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div align="center" style="margin: 20px;">
                <img src="/../uploads/img/reward/<?if (!$aword4) {?>no<?}?>4.png" width="150px"><br>
                                        <span class="font-yellow-crusta font-lg">
                                            <i class="fa fa-star" aria-hidden="true" ></i>
                                            <i class="fa fa-star-o" aria-hidden="true" ></i>
                                            <i class="fa fa-star-o" aria-hidden="true" ></i>
                                        </span>
                <br>
                Эта награда за Ваш первый платеж на сайте. Дополнительно к бонусному счету будет добавлено 10 бонусов. А также 0,5% от каждого следующего пополнения.
            </div>
        </div>
    </div>
</div>
<div class="modal fade aw5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div align="center" style="margin: 20px;">
                <img src="/../uploads/img/reward/<?if (!$aword5) {?>no<?}?>5.png" width="150px"><br><br>
                Вы уже были в нашем интернет-магазине? При совершении любой покупки Вы получаете эту награду и 5 бонусов на счет!
            </div>
        </div>
    </div>
</div>
<div class="modal fade aw6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div align="center" style="margin: 20px;">
                <img src="/../uploads/img/reward/<?if (!$aword6) {?>no<?}?>6.png" width="150px"><br><br>
                Кому, как не Вам известно, что всегда нужно быть первым! Награда за приобретение премиум статуса для машины или купона.
            </div>
        </div>
    </div>
</div>
<div class="modal fade aw7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div align="center" style="margin: 20px;">
                <img src="/../uploads/img/reward/<?if (!$aword7) {?>no<?}?>7.png" width="150px"><br><br>
                Похоже, что Вы собрали все основные награды. Администрация откроет эту и даст 50 бонусов на счет!
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->