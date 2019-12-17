<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Рекламные кампании', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(); ?>

<div class="col-md-8">
<?= $form->field($model, 'text')->textarea(['rows' => 7])->label('Рекламный текст') ?>
</div>
<div class="col-md-4">
    Планируемый срок размещения
    <div class="md-radio-list">
        <div class="col-xs-6">
    <?= $form->field($model, 'period')->radioList(
        ['1'=>'1 месяц','2'=>'2 месяца','3'=>'3 месяца','4'=>'4 месяца'],
        ['item' => function($index, $label, $name, $checked, $value) {
            $check = $checked ? ' checked="checked"' : '';
            $return = '<div class="md-radio">';
            $return .= '<input class="md-radiobtn" type="radio" id="radio'.$value.'" name="' . $name . '" value="' . $value . '" tabindex="3" '.$check.'>';
            $return .= '<label for="radio'.$value.'"><span class="inc"></span><span class="check"></span><span class="box"></span> '.$label.' </label>';
            $return .= '</div>';
            return $return;
        }
        ]
    )->label('') ?>
        </div>
        <div class="col-xs-6">
    <?= $form->field($model, 'period')->radioList(
        ['5'=>'5 месяцев','6'=>'6 месяцев','7'=>'1 год','8'=>'Бессрочно'],
        ['item' => function($index, $label, $name, $checked, $value) {
            $check = $checked ? ' checked="checked"' : '';
            $return = '<div class="md-radio">';
            $return .= '<input class="md-radiobtn" type="radio" id="radio'.$value.'" name="' . $name . '" value="' . $value . '" tabindex="3" '.$check.'>';
            $return .= '<label for="radio'.$value.'"><span class="inc"></span><span class="check"></span><span class="box"></span> '.$label.' </label>';
            $return .= '</div>';
            return $return;
        }
        ]
    )->label('') ?>
    </div>
   </div>

</div>
<div class="clearfix"></div>
<br>
<div class="col-xs-12">
<?= Html::submitButton('Перейти к выбору рекламных площадок', ['class' => 'btn blue btn-block']) ?>
</div>

<?php ActiveForm::end(); ?>
