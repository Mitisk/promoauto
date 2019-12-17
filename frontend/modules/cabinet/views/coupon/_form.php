<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-4">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Заголовок*') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'category')->textInput(['maxlength' => true])->label('Категория*')->dropDownList(['shop' => 'Магазины', 'food' => 'Рестораны', 'service' => 'Сервис', 'fun' => 'Развлечения', 'other' => 'Другое']) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'size')->textInput(['maxlength' => true])->label('Размер скидки') ?>
    </div><div class="clearfix"></div>
    <div class="col-md-4">
        <?= $form->field($model, 'code')->textInput(['maxlength' => true])->label('Промокод') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('Ссылка') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'date')->textInput()->label('Действует до*') ?>
    </div>
    <div class="col-xs-12">
    <?= $form->field($model, 'text')->textarea(['rows' => 6])->label('Описание*') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Отправить на модерацию' : 'Отправить на модерацию', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
<br>
    <?php ActiveForm::end(); ?>

