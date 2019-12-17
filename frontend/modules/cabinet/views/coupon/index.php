<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Купоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .couponbody {
        border-right: solid 1px #ddd;
        border-left: solid 1px #ddd;
        margin-bottom: 0;
        padding-bottom: 10px;
        min-height: 160px;
    }
    .couponheader {
        color: white;
        background-image: url("/../uploads/img/coupon_header.jpg");
        height: 100px;
        padding-top: 1px;
    }
</style>
<div class="row">
    <div class="col-md-9">
        <a href="<?= Url::toRoute('index')?>" class="icon-btn">
            <i class="fa fa-bars"></i>
            <div> Все </div>
        </a>
        <a href="<?= Url::toRoute('index?cat=shops')?>" class="icon-btn">
            <i class="fa fa-shopping-cart"></i>
            <div> Магазины </div>
            <? if($catshop > 0) {?><span class="badge badge-danger"> <?= $catshop ?> </span><?}?>
        </a>
        <a href="<?= Url::toRoute('index?cat=food')?>" class="icon-btn">
            <i class="fa fa-coffee"></i>
            <div> Рестораны </div>
            <? if($catfood > 0) {?><span class="badge badge-danger"> <?=$catfood?> </span><?}?>
        </a>
        <a href="<?= Url::toRoute('index?cat=service')?>" class="icon-btn">
            <i class="fa fa-wrench"></i>
            <div> Сервис </div>
            <? if($catservice > 0) {?><span class="badge badge-danger"> <?=$catservice?> </span><?}?>
        </a>
        <a href="<?= Url::toRoute('index?cat=fun')?>" class="icon-btn">
            <i class="fa fa-smile-o"></i>
            <div> Развлечения </div>
            <? if($catfun > 0) {?><span class="badge badge-danger"> <?=$catfun?> </span><?}?>
        </a>
        <a href="<?= Url::toRoute('index?cat=other')?>" class="icon-btn">
            <i class="fa fa-star"></i>
            <div> Другое </div>
            <? if($catother > 0) {?><span class="badge badge-danger"> <?=$catother?> </span><?}?>
        </a>
    </div>
    <div class="col-md-3" align="right">
        <a href="<?= Url::toRoute('my')?>" class="icon-btn">
            <i class="fa fa-star-o"></i>
            <div> Мои </div>
            <? if($usercount > 0) {?><span class="badge badge-danger"> <?=$usercount?> </span><?}?>
        </a>
        <a href="<?= Url::toRoute('create')?>" class="icon-btn">
            <i class="fa fa-plus"></i>
            <div> Добавить </div>
        </a>
    </div>
</div><br><br>
<div class="col-md-12">
    <? foreach ($coupons as $coupon) { ?>
    <div class="col-md-3" style="height: 310px;margin-bottom: 10px;">
        <div class="coupon">
            <div class="couponheader" align="center"><h2>
                    <? if ($coupon->size) {?>
                    <?= $coupon->size ?><? } else {?>
                    <i class="fa fa-gift" aria-hidden="true"></i>
                    <?}?>
                </h2>
                <? if ($coupon->vip) { ?>  <span class="badge badge-warning badge-roundless"> VIP </span> <?}?>
                <? if ($coupon->recommend) { ?><span class="badge badge-primary badge-roundless"> рекомендуем </span><?}?>
            </div>
            <div class="couponbody">
                <div class="col-xs-6">
                </div><div class="col-xs-6" align="center" style="font-size: 7pt;">
                    <p style="color: grey; margin-bottom: -1px;">ДЕЙСТВУЕТ ДО</p>
                    <?= $coupon->date ?>

                </div>
                <div class="clearfix"></div>
                <p style="text-align: center; color: grey; font-size: 10pt;">
                    <?= $coupon->name ?>
                </p>
            </div>
            <a href="<?= Url::to(['coupon/view?id='.$coupon->id])?>" class="btn blue btn-block">Подробнее</a>
        </div>
    </div>
    <? } ?>
    <div class="col-md-12" align="center">
    <?=LinkPager::widget([
        'pagination' => $pages,
    ]);?>
</div>
</div>






