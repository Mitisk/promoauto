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
    $point4 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'down', 'place' => '1'])->one();
    $point5 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'down', 'place' => '2'])->one();
    $point6 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'right', 'place' => '2'])->one();
    $point7 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'right', 'place' => '1'])->one();
    if ($view == 'view') {
        $price_for1 = Func::priceforrus($point1->price_for);
        $price_for2 = Func::priceforrus($point2->price_for);
        $price_for3 = Func::priceforrus($point3->price_for);
        $price_for4 = Func::priceforrus($point4->price_for);
        $price_for5 = Func::priceforrus($point5->price_for);
        $price_for6 = Func::priceforrus($point6->price_for);
        $price_for7 = Func::priceforrus($point7->price_for);
    }
}
$name1 = 'Капот';
$name2 = 'Левая передняя дверь';
$name3 = 'Левый борт';
$name4 = 'Заднее окно';
$name5 = 'Задний борт';
$name6 = 'Правый борт';
$name7 = 'Правая передняя дверь';
?>
<style type="text/css">
    .side {
        position: relative;
        height: 284px;
        width: 521px;
        background-image: url(../../uploads/img/autosparts/platforma.jpg);
    }
    .item {
        display: block;
    }
    .point {
        display: block;
        position: absolute;
    }
    .point1 {
        left: 12%;
        top: 18%;
    }
    .point2 {
        left: 43%;
        top: 16%;
    }
    .point3 {
        left: 72%;
        top: 16%;
    }
    .point4 {
        left: 12%;
        top: 58%;
    }
    .point5 {
        left: 12%;
        top: 74%;
    }
    .point6 {
        left: 58%;
        top: 73%;
    }
    .point7 {
        left: 86%;
        top: 73%;
    }

</style>

<? if ($view == 'edit') { Pricetable::modal(7); } if($view != 'campaign'){ ?>
<div class="col-md-8 col-lg-7" align="center"><br>
    <div class="side">
        <? Pricetable::item('1', $point1, $view, $point1->price, $price_for1, $name1, $id, 'up', '1', Null) ?>
        <? Pricetable::item('2', $point2, $view, $point2->price, $price_for2, $name2, $id, 'left', '1', Null) ?>
        <? Pricetable::item('3', $point3, $view, $point3->price, $price_for3, $name3, $id, 'left', '2', Null) ?>
        <? Pricetable::item('4', $point4, $view, $point4->price, $price_for4, $name4, $id, 'down', '1', Null) ?>
        <? Pricetable::item('5', $point5, $view, $point5->price, $price_for5, $name5, $id, 'down', '2', Null) ?>
        <? Pricetable::item('6', $point6, $view, $point6->price, $price_for6, $name6, $id, 'right', '2', Null) ?>
        <? Pricetable::item('7', $point7, $view, $point7->price, $price_for7, $name7, $id, 'right', '1', Null) ?>
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