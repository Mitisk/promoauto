<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? if ($model->text) {?>
            <div class="col-xs-12 col-md-6">
            Автовладелец оставил следующий комментарий:<br>
            <?= $model->text ?>
            </div>
        <?}?>
    </p>


</div>
