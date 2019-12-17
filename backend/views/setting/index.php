<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить строку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <table class="table table-bordered">
        <tr>
            <td class="active">ID</td>
            <td class="success">Название</td>
            <td class="warning">Значение</td>
            <td class="danger">Опции</td>
        </tr>
    <? foreach ($datas as $data) { ?>
        <tr>
            <td class="active"><?=$data->id?></td>
            <td class="success"><?=$data->name?></td>
            <td class="warning"><?=$data->value?></td>
            <td class="danger"><?= Html::a('Изменить', ['update', 'id' => $data->id], [
                    'class' => 'btn btn-info',
                ]) ?>

                <?= Html::a('Удалить', ['delete', 'id' => $data->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить?',
                        'method' => 'post',
                    ],
                ]) ?></td>
        </tr>
    <? } ?>
    </table>
    <br><br><br><br>

    <?php Pjax::begin(); ?>
    <?= Html::a("Обновить", ['index'], ['class' => 'btn btn-lg btn-primary']) ?>
    <h1>Сейчас: <?= $time ?></h1>
    <?php Pjax::end(); ?>
    <br><br><br>

</div>