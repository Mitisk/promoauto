<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Autos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="autos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'auto_user_id')->textInput() ?>

    <?= $form->field($model, 'auto_location_id')->textInput() ?>

    <?= $form->field($model, 'auto_date')->textInput() ?>

    <?= $form->field($model, 'auto_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auto_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auto_price_for')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auto_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auto_view')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auto_mark_id')->textInput() ?>

    <?= $form->field($model, 'auto_model_id')->textInput() ?>

    <?= $form->field($model, 'auto_year')->textInput() ?>

    <?= $form->field($model, 'auto_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auto_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auto_damage')->textInput() ?>

    <?= $form->field($model, 'auto_parking')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'auto_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'auto_confirmed')->textInput() ?>

    <?= $form->field($model, 'auto_occupied')->textInput() ?>

    <?= $form->field($model, 'auto_vip')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>