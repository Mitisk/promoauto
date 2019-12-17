<?php
use common\models\AutoAdvertPlace;
use frontend\components\Pricetable;
use yii\helpers\Html;
use frontend\components\Func;
//Версия 2

if($view != 'campaign'){
$point1 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'up','place'=>'1'])->one();
$point2 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'left','place'=>'1'])->one();
$point3 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'right','place'=>'1'])->one();
if ($view == 'view') {
    $price_for1 = Func::priceforrus($point1->price_for);
    $price_for2 = Func::priceforrus($point2->price_for);
    $price_for3 = Func::priceforrus($point3->price_for);
}}
?>
<style type="text/css">
    .side {
        position: relative;
        height: 250px;
        width: 521px;
        background-image: url(../../uploads/img/autosparts/kabrio.jpg);
    }
    .item {
        display: block;
    }
    .point {
        display: block;
        position: absolute;
    }
    .point1 {
        left: 11%;
        top: 36%;
    }
    .point2 {
        left: 44%;
        top: 50%;
    }
    .point3 {
        left: 44%;
        top: 50%;
    }
</style>

<? if ($view == 'edit') { Pricetable::modal(3); } if($view != 'campaign'){ ?>

<div class="col-xs-12 col-md-8 col-lg-7" align="center">
    <div class="side">
        <? Pricetable::item('1', $point1, $view, $point1->price, $price_for1, 'Брендирование капота', $id, 'up', '1', Null) ?>
        <? Pricetable::item('2', $point2, $view, $point2->price, $price_for2, 'Брендирование левой двери', $id, 'left', '1', Null) ?>
    </div>
    <div class="side" style="transform: scale(-1, 1)">
        <? Pricetable::item('3', $point3, $view, $point3->price, $price_for3, 'Брендирование правой двери', $id, 'right', '1', '1') ?>
    </div>
</div>

<? } if ($view == 'edit') {
    //Скрипт для вывода модальных окон при добавлении автомобиля.
    ?>
<script type="text/javascript">
    point1.onclick = function() {
        var url = $(this).attr('href');
        var modal = $('.unit1');
        $.get(url, function(data) {
            modal.html(data).modal('show');
        });
        return false;
    };
    point2.onclick = function() {
        var url = $(this).attr('href');
        var modal = $('.unit2');
        $.get(url, function(data) {
            modal.html(data).modal('show');
        });
        return false;
    };
    point3.onclick = function() {
        var url = $(this).attr('href');
        var modal = $('.unit3');
        $.get(url, function(data) {
            modal.html(data).modal('show');
        });
        return false;
    };
    sendForm.onclick = function() {
        var form = $(this).closest('form');
        $.post(
            form.attr('action'),
            form.serialize(),
            function(data) {
                //window.location.reload();
                $('.modal').modal('hide');
            }
        );
        return false;
    };
</script>
<?} elseif ($view == 'view') {?>
<div class="col-md-4 col-lg-5" align="center">
    <div class="table-scrollable">
        <table class="table table-hover">
            <thead>
            <tr>
                <th> № </th>
                <th> Стоимость </th>
                <th> Добавить </th>
            </tr>
            </thead>
            <tbody>
    <?if ($point1) {
        Pricetable::tr('1', $point1->price, $price_for1, $campaignscount, $campaigns, $point1->status, $point1->auto_id, $point1->id);
    } if ($point2) {
        Pricetable::tr('2', $point2->price, $price_for2, $campaignscount, $campaigns, $point2->status, $point2->auto_id, $point2->id);
    } if ($point3) {
        Pricetable::tr('3', $point3->price, $price_for3, $campaignscount, $campaigns, $point3->status, $point3->auto_id, $point3->id);
    } if ($model->auto_price > 0){ ?>
            <tr>
                <td></td>
                <td>
                    Полное брендирование автомобиля <?= Html::encode($model->auto_price) ?> рублей <?= Html::encode($model->auto_price_for) ?>
                </td>
                <td align="center">
                    <a type="button" class="btn btn-info" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                </td>
            </tr>
            <? } ?>
            </tbody>
        </table>
    </div>
</div>
<?} elseif ($view == 'campaign') {?>
    <div class="row">
        <? Pricetable::campaign($side, $point) ?>
    </div>
<?}?>
