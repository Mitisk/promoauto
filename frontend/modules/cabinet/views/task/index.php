<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задания';
$this->params['breadcrumbs'][] = $this->title;
?>
<?if ($tasks_for_me) {?>
    <div class="col-xs-12">
        <H1>Задания:</H1>
        <div class="table-scrollable table-scrollable-borderless">
            <table class="table table-hover table-light">
                <tbody>
                <? foreach ($tasks_for_me as $task) {?>
                    <tr <? if (!$task->status) {echo 'class="warning"';}?>>
                        <td><?=$task->name?> <?
                            if ($task->status == '1') {
                                echo '<span class="label label-info"><i class="fa fa-spinner" aria-hidden="true"></i> в работе </span>';
                            }
                            if ($task->status == '2') {
                                echo '<span class="label label-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i> выполнено </span>';
                            }
                            ?></td>

                        <td>
                            <? echo Yii::$app->formatter->asDatetime($task->date, "php:d.m.Y H:i");?>
                        </td>
                        <td align="right">
                            <? if ($task->status != '2') {
                                echo Html::a('Смотреть', ['campaignplace/view', 'id' => $task->campaign_place_id], ['class' => 'btn blue']);
                            } if ($task->status == '0') {
                                echo Html::a('Начать', ['task/to-begin', 'id' => $task->id, 'campaignplaceid' => $task->campaign_place_id], ['class' => 'btn blue']);
                            }
                            if ($task->view == '10') {
                                echo Html::a('Смотреть', ['task/view', 'id' => $task->id], ['class' => 'btn blue']);
                            }
                            ?>
                        </td>
                    </tr>
                <?}?>
                </tbody>
            </table>
        </div>
    </div>
<?}?>

<?if ($tasks) {?>
    <div class="col-xs-12">
        <hr>
        <H1>Вы дали задания:</H1>
        <div class="table-scrollable table-scrollable-borderless">
            <table class="table table-hover table-light">
                <tbody>
                <? foreach ($tasks as $task) {?>
                    <tr <? if (!$task->status) {echo 'class="warning"';}?>>
                        <td><?=$task->name?> <?
                            if ($task->status == '1') {
                                echo '<span class="label label-info"><i class="fa fa-spinner" aria-hidden="true"></i> в работе </span>';
                            }
                            if ($task->status == '2') {
                                echo '<span class="label label-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i> выполнено </span>';
                            }
                            ?></td>

                        <td>
                            <? echo Yii::$app->formatter->asDatetime($task->date, "php:d.m.Y H:i");?>
                        </td>
                        <td align="right">
                            <? if ($task->status != '2') {
                                echo Html::a('Смотреть', ['campaignplace/view', 'id' => $task->campaign_place_id], ['class' => 'btn blue']);
                                echo Html::a('Жалоба', ['support/create', 'mess' => 'Авовладелец не выполняет свои обязательства. Идентификатор ' . $model->id], ['class' => 'btn blue']);
                            }
                            if ($task->view == '10') {
                                echo Html::a('Смотреть', ['task/view', 'id' => $task->id], ['class' => 'btn blue']);
                            }
                            ?>
                        </td>
                    </tr>
                <?}?>
                </tbody>
            </table>
        </div>
    </div>
<?}?>
