<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Подтверждение выполнения задания';
$this->params['breadcrumbs'][] = ['label' => 'Задания', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'text')->textarea(['rows' => 3])->label('Комментарий') ?>


    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
