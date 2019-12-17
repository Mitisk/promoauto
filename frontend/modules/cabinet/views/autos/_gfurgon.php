<?php
use common\models\AutoAdvertPlace;
use frontend\components\Pricetable;
use yii\helpers\Html;
use frontend\components\Func;
//Версия 2
?>
<br>
<div class="col-md-8 col-lg-7" align="center" style="height: 550px;">
<? if ($view == 'edit') { Pricetable::modal(8); } elseif ($view == 'view') {if ($campaignscount >= 2) {$campaigns = $querycampaign->all();}}?>
<? if (!$modelview and $view == 'edit') {?>
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <div style="text-transform:none">
                <p>Пожалуйста, выберите подходящий кузов автомобиля для продолжения.</p>
            </div>
        </div>

        <style type="text/css">
            .chose {
                display: inline-block;
                width: 290px;
                height: 132px;
                border: dashed 2px #fff;
            }
            .chose:hover {
                border: dashed 2px;
                background-color: #E6E6FA;
            }
            .chose1 {
                background: url(../../uploads/img/autosparts/furgon-icon.png) no-repeat center;
            }
            .chose2 {
                background: url(../../uploads/img/autosparts/furgon-icon-2.png) no-repeat center;
            }
        </style>
        <a href="chose?type=1" class="chose chose1"></a>
        <a href="chose?type=2" class="chose chose2"></a>
<?} if ($modelview == '1') {
//Вид 1
if($view != 'campaign') {
    $point1 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'up', 'place' => '1'])->one();
    $point2 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'left', 'place' => '1'])->one();
    $point3 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'left', 'place' => '2'])->one();
    $point4 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'left', 'place' => '3'])->one();
    $point5 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'right', 'place' => '2'])->one();
    $point6 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'right', 'place' => '1'])->one();
    $point7 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'down', 'place' => '1'])->one();
    $point8 = AutoAdvertPlace::find()->where(['auto_id' => $id, 'side' => 'down', 'place' => '2'])->one();
    if ($view == 'view') {
        $price_for1 = Func::priceforrus($point1->price_for);
        $price_for2 = Func::priceforrus($point2->price_for);
        $price_for3 = Func::priceforrus($point3->price_for);
        $price_for4 = Func::priceforrus($point4->price_for);
        $price_for5 = Func::priceforrus($point5->price_for);
        $price_for6 = Func::priceforrus($point6->price_for);
        $price_for7 = Func::priceforrus($point7->price_for);
        $price_for8 = Func::priceforrus($point8->price_for);
    }
}
    $name1 = 'Капот';
    $name2 = 'Левая передняя дверь';
    $name3 = 'Левая задняя дверь';
    $name4 = 'Левый борт';
    $name5 = 'Правый борт';
    $name6 = 'Правая передняя дверь';
    $name7 = 'Левая дверь';
    $name8 = 'Правая дверь';
?>
    <style type="text/css">
        .furgon-side-left {
            position: relative;
            height: 244px;
            width: 521px;
            background-image: url(../../uploads/img/autosparts/furgon.jpg);
        }
        .furgon-side-right {
            position: relative;
            height: 244px;
            width: 521px;
            background-image: url(../../uploads/img/autosparts/furgon-right.jpg);
        }
        .furgon-side-down {
            position: relative;
            height: 391px;
            width: 521px;
            background-image: url(../../uploads/img/autosparts/furgon-down.jpg);
        }
        .item {
            display: block;
        }
        .point {
            display: block;
            position: absolute;
        }
        .point1 {
            left: 4%;
            top: 42%;
        }
        .point2 {
            left: 20%;
            top: 53%;
        }
        .point3 {
            left: 39%;
            top: 45%;
        }
        .point4 {
            left: 68%;
            top: 31%;
        }
        .point5 {
            left: 57%;
            top: 31%;
        }
        .point6 {
            left: 20%;
            top: 53%;
        }
        .point7 {
            left: 60%;
            top: 22%;
        }
        .point8 {
            left: 81%;
            top: 22%;
        }
        .point9 {
            left: 93%;
            top: 30%;
        }
        .point10 {
            left: 30%;
            top: 22%;
        }
    </style>

    <? if($view != 'campaign'){ ?>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tab_1_1">
        <!-- Вкладка 1 -->
            <div class="furgon-side-left">
                <? Pricetable::item('1', $point1, $view, $point1->price, $price_for1, $name1, $id, 'up', '1', Null) ?>
                <? Pricetable::item('2', $point2, $view, $point2->price, $price_for2, $name2, $id, 'left', '1', Null) ?>
                <? Pricetable::item('3', $point3, $view, $point3->price, $price_for3, $name3, $id, 'left', '2', Null) ?>
                <? Pricetable::item('4', $point4, $view, $point4->price, $price_for4, $name4, $id, 'left', '3', Null) ?>
                <div class="item">
                    <a href="#tab_1_2" data-toggle="tab" aria-expanded="false" class="point point9 btn btn-circle btn-icon-only btn-default">
                        <i class="fa fa-<? if($view == 'edit') {echo 'cogs';}else{echo 'eye';} ?>"></i>
                    </a>
                </div>
            </div>
            <div class="furgon-side-right" style="transform: scale(-1, 1)"><br><br>
            <? Pricetable::item('5', $point5, $view, $point5->price, $price_for5, $name5, $id, 'right', '2', '1') ?>
            <? Pricetable::item('6', $point6, $view, $point6->price, $price_for6, $name6, $id, 'right', '1', '1') ?>
            </div>
        <!-- Конец Вкладка 1 -->
        </div>
        <div class="tab-pane fade" id="tab_1_2">
            <!-- Вкладка 2 -->
            <div class="furgon-side-down">
            <? Pricetable::item('7', $point7, $view, $point7->price, $price_for7, $name7, $id, 'down', '1', Null) ?>
            <? Pricetable::item('8', $point8, $view, $point8->price, $price_for8, $name8, $id, 'down', '2', Null) ?>
                <div class="item">
                    <a href="#tab_1_1" data-toggle="tab" aria-expanded="false" class="point point10 btn btn-circle btn-icon-only btn-default">
                        <i class="fa fa-<? if($view == 'edit') {echo 'cogs';}else{echo 'eye';} ?>"></i>
                    </a>
                </div>
            </div>
            <!-- Конец Вкладка 2 -->
        </div>
    </div>
<!-- Конец Вид 1 -->
<?}} elseif ($modelview == '2') {
//Вид 2
if($view != 'campaign') {
    $point1 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'left','place'=>'1'])->one();
    $point2 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'left','place'=>'2'])->one();
    $point3 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'right','place'=>'2'])->one();
    $point4 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'right','place'=>'1'])->one();
    $point5 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'up','place'=>'1'])->one();
    $point6 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'up','place'=>'2'])->one();
    $point7 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'down','place'=>'1'])->one();
    $point8 = AutoAdvertPlace::find()->where(['auto_id'=>$id,'side'=>'down','place'=>'2'])->one();
    if ($view == 'view') {
        $price_for1 = Func::priceforrus($point1->price_for);
        $price_for2 = Func::priceforrus($point2->price_for);
        $price_for3 = Func::priceforrus($point3->price_for);
        $price_for4 = Func::priceforrus($point4->price_for);
        $price_for5 = Func::priceforrus($point5->price_for);
        $price_for6 = Func::priceforrus($point6->price_for);
        $price_for7 = Func::priceforrus($point7->price_for);
        $price_for8 = Func::priceforrus($point8->price_for);
    }
}?>
    <style type="text/css">
        .furgon-side-2 {
            position: relative;
            height: 240px;
            width: 520px;
            background-image: url(../../uploads/img/autosparts/furgon-2.jpg);
        }
        .furgon-side-down-2 {
            position: relative;
            height: 269px;
            width: 521px;
            background-image: url(../../uploads/img/autosparts/furgon-down-2.jpg);
        }
        .item {
            display: block;
        }
        .point {
            display: block;
            position: absolute;
        }
        .point1 {
             left: 17%;
             top: 53%;
         }
        .point2 {
            left: 59%;
            top: 30%;
        }
        .point5 {
            left: 26%;
            top: 10%;
        }
        .point6 {
            left: 26%;
            top: 56%;
        }
        .point7 {
            left: 65%;
            top: 35%;
        }
        .point8 {
            left: 79%;
            top: 35%;
        }
        .point9 {
            left: 4%;
            top: 53%;
        }
        .point10 {
            left: 91%;
            top: 30%;
        }
        .point11 {
            left: 91%;
            top: 30%;
        }
    </style>
<? if($view != 'campaign'){ ?>
    <div class="tab-content">
    <div class="tab-pane fade active in" id="tab_2_1">
        <!-- Вкладка 3 -->
        <div class="furgon-side-2">
            <div class="item">
                <a href="#tab_2_2" data-toggle="tab" aria-expanded="false" class="point point9 btn btn-circle btn-icon-only btn-default">
                    <i class="fa fa-<? if($view == 'edit') {echo 'cogs';}else{echo 'eye';} ?>"></i>
                </a>
            </div>
            <? Pricetable::item('1', $point1, $view, $point1->price, $price_for1, $name1, $id, 'left', '1', Null) ?>
            <? Pricetable::item('2', $point2, $view, $point2->price, $price_for2, $name2, $id, 'left', '2', Null) ?>
            <div class="item">
                <a href="#tab_2_2" data-toggle="tab" aria-expanded="false" class="point point10 btn btn-circle btn-icon-only btn-default">
                    <i class="fa fa-<? if($view == 'edit') {echo 'cogs';}else{echo 'eye';} ?>"></i>
                </a>
            </div>
        </div>
        <div class="furgon-side-2" style="transform: scale(-1, 1)"><br><br>
            <? Pricetable::item('3', $point3, $view, $point3->price, $price_for3, $name3, $id, 'right', '2', '1') ?>
            <? Pricetable::item('4', $point4, $view, $point4->price, $price_for4, $name4, $id, 'right', '3', '1') ?>
        </div>
        <!-- Конец Вкладка 3 -->
    </div>
    <div class="tab-pane fade" id="tab_2_2">
        <!-- Вкладка 4 -->
        <div class="furgon-side-down-2">
            <div class="item">
            <? Pricetable::item('5', $point5, $view, $point5->price, $price_for5, $name5, $id, 'down', '1', Null) ?>
            <? Pricetable::item('6', $point6, $view, $point6->price, $price_for6, $name6, $id, 'right', '3', Null) ?>
            <? Pricetable::item('7', $point7, $view, $point7->price, $price_for7, $name7, $id, 'right', '2', Null) ?>
            <? Pricetable::item('8', $point8, $view, $point8->price, $price_for8, $name8, $id, 'right', '1', Null) ?>
            <div class="item">
                <a href="#tab_2_1" data-toggle="tab" aria-expanded="false" class="point point11 btn btn-circle btn-icon-only btn-default">
                    <i class="fa fa-<? if($view == 'edit') {echo 'cogs';}else{echo 'eye';} ?>"></i>
                </a>
            </div>
        </div>

        <!-- Конец Вкладка 4 -->
    </div>
    </div>
<!-- Конец Вид 2 -->
<?}}?>
</div>

<? if ($view == 'edit') {
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