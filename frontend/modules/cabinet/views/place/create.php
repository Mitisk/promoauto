<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AutoAdvertPlace */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="modal-dialog">
    <div class="modal-content">

<div class="modal-header">
    <h4 class="modal-title">Установить стоимость</h4>
</div>
<div class="modal-body">
<?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-6">
<?= $form->field($model, 'price')->textInput()->label('') ?>
    </div>
    <div class="col-xs-6">
<?= $form->field($model, 'price_for')->dropDownList(['forday' => 'за день', 'forweak' => 'за неделю', 'formonth' => 'за месяц', '100km' => 'за 100 км', '500km' => 'за 500 км', '1000km' => 'за 1 000 км'])->label('') ?>
    </div>
    <div class="clearfix">
    </div>
    <div class="modal-footer">
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'sendForm']) ?>
</div>

<?php ActiveForm::end(); ?>
    </div>
</div>
    </div>