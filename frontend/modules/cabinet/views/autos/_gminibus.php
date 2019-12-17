<?php
use common\models\AutoAdvertPlace;
use frontend\components\Pricetable;
use yii\helpers\Html;
use frontend\components\Func;
//Версия 2
if($view != 'campaign') {
    $point1 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'up', 'place' => '1'])->one();
    $point2 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'left', 'place' => '1'])->one();
    $point3 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'left', 'place' => '2'])->one();
    $point4 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'left', 'place' => '3'])->one();
    $point5 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'down', 'place' => '1'])->one();
    $point6 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'right', 'place' => '3'])->one();
    $point7 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'right', 'place' => '2'])->one();
    $point8 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'right', 'place' => '1'])->one();
    if ($view == 'view') {
        $price_for1 = Func::priceforrus($point1->price_for);
        $price_for2 = Func::priceforrus($point2->price_for);
        $price_for3 = Func::priceforrus($point3->price_for);
        $price_for4 = Func::priceforrus($point4->price_for);
        $price_for5 = Func::priceforrus($point5->price_for);
        $price_for6 = Func::priceforrus($point6->price_for);
        $price_for7 = Func::priceforrus($point6->price_for);
        $price_for8 = Func::priceforrus($point6->price_for);
    }
}
$name1 = 'Капот';
$name2 = 'Левая передняя дверь';
$name3 = 'Левая задняя дверь';
$name4 = 'Левое окно багажника';
$name5 = 'Заднее окно';
$name6 = 'Правое окно багажника';
$name7 = 'Правая задняя дверь';
$name8 = 'Правая передняя дверь';
?>
<style type="text/css">
    .side {
        position: relative;
        height: 217px;
        width: 521px;
        background-image: url(../../uploads/img/autosparts/minibus.jpg);
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
        top: 38%;
    }
    .point2 {
        left: 28%;
        top: 48%;
    }
    .point3 {
        left: 49%;
        top: 48%;
    }
    .point4 {
        left: 70%;
        top: 22%;
    }
    .point5 {
        left: 85%;
        top: 19%;
    }
    .point6 {
        left: 70%;
        top: 22%;
    }
    .point7 {
        left: 49%;
        top: 48%;
    }
    .point8 {
        left: 28%;
        top: 48%;
    }
</style>

<? if ($view == 'edit') { Pricetable::modal(8); } if($view != 'campaign'){ ?>
    <div class="col-md-8 col-lg-7" align="center">
        <div class="side">
            <? Pricetable::item('1', $point1, $view, $point1->price, $price_for1, $name1, $id, 'up', '1', Null) ?>
            <? Pricetable::item('2', $point2, $view, $point2->price, $price_for2, $name2, $id, 'left', '1', Null) ?>
            <? Pricetable::item('3', $point3, $view, $point3->price, $price_for3, $name3, $id, 'left', '2', Null) ?>
            <? Pricetable::item('4', $point4, $view, $point4->price, $price_for4, $name4, $id, 'left', '3', Null) ?>
            <? Pricetable::item('5', $point5, $view, $point5->price, $price_for5, $name5, $id, 'down', '1', Null) ?>
        </div>
        <div class="side" style="transform: scale(-1, 1)">
            <? Pricetable::item('6', $point6, $view, $point6->price, $price_for6, $name6, $id, 'right', '3', '1') ?>
            <? Pricetable::item('7', $point7, $view, $point7->price, $price_for7, $name7, $id, 'right', '2', '1') ?>
            <? Pricetable::item('8', $point8, $view, $point8->price, $price_for8, $name8, $id, 'right', '1', '1') ?>
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
        point4.onclick = function() {
            var url = $(this).attr('href');
            var modal = $('.unit4');
            $.get(url, function(data) {
                modal.html(data).modal('show');
            });
            return false;
        };
        point5.onclick = function() {
            var url = $(this).attr('href');
            var modal = $('.unit5');
            $.get(url, function(data) {
                modal.html(data).modal('show');
            });
            return false;
        };
        point6.onclick = function() {
            var url = $(this).attr('href');
            var modal = $('.unit6');
            $.get(url, function(data) {
                modal.html(data).modal('show');
            });
            return false;
        };
        point7.onclick = function() {
            var url = $(this).attr('href');
            var modal = $('.unit7');
            $.get(url, function(data) {
                modal.html(data).modal('show');
            });
            return false;
        };
        point8.onclick = function() {
            var url = $(this).attr('href');
            var modal = $('.unit8');
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
<?} elseif ($view == 'view') { ?>
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
                <? if ($point1) {
                    Pricetable::tr('1', $point1->price, $price_for1, $campaignscount, $campaigns, $point1->status, $point1->auto_id, $point1->id);
                } if ($point2) {
                    Pricetable::tr('2', $point2->price, $price_for2, $campaignscount, $campaigns, $point2->status, $point2->auto_id, $point2->id);
                } if ($point3) {
                    Pricetable::tr('3', $point3->price, $price_for3, $campaignscount, $campaigns, $point3->status, $point3->auto_id, $point3->id);
                } if ($point4) {
                    Pricetable::tr('4', $point4->price, $price_for4, $campaignscount, $campaigns, $point4->status, $point4->auto_id, $point4->id);
                } if ($point5) {
                    Pricetable::tr('5', $point5->price, $price_for5, $campaignscount, $campaigns, $point5->status, $point5->auto_id, $point5->id);
                } if ($point6) {
                    Pricetable::tr('6', $point6->price, $price_for6, $campaignscount, $campaigns, $point6->status, $point6->auto_id, $point6->id);
                } if ($point7) {
                    Pricetable::tr('7', $point7->price, $price_for7, $campaignscount, $campaigns, $point7->status, $point7->auto_id, $point7->id);
                } if ($point8) {
                    Pricetable::tr('8', $point8->price, $price_for8, $campaignscount, $campaigns, $point8->status, $point8->auto_id, $point8->id);
                }?>
                <? if ($model->auto_price > 0){ ?>
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
    <div class="row"><br>
        <?
        Pricetable::campaign($side, $point) ?>
    </div>
<?}?>