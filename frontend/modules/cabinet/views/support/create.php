<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Support */

$this->title = 'Создание обращения';
$this->params['breadcrumbs'][] = ['label' => 'Поддержка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
