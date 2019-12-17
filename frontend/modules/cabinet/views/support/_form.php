<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Support */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="support-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->textInput()->label('Категория')->dropDownList(['common'=>'Общий вопрос','technical'=>'Технический вопрос']) ?>

    <?$model->question = Yii::$app->request->get('mess');?>

    <?= $form->field($model, 'question')->textarea(['rows' => 6])->label('Вопрос') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Отправить' : 'Отправить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
