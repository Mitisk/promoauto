<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\AutoMark;
use common\models\AutoModel;
?>
<link href="/./layout/css/addauto.css" rel="stylesheet">
<?php $form = ActiveForm::begin(); ?>
<div class="col-xs-12">
<?= $form->field($model, 'auto_type')
    ->radioList(
        ['sedan'=>'Седан','universal'=>'Универсал','vnedorojnik'=>'Внедорожник','minivan'=>'Минивэн','kabrio'=>'Кабриолет',
            'pickup'=>'Пикап','minibus'=>'Миниавтобус','furgon'=>'Фургон','platform'=>'Платформа'],
        [
            'item' => function($index, $label, $name, $checked, $value) {
                $check = $checked ? ' checked="checked"' : '';
                $return = '<div class="col-md-1" id="autotype" style="width: 11.11111%;margin-top: 12px;"><label class="'. $value .'">';
                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3" '.$check.'>';
                $return .= '<span></span><p>' . ucwords($label) . '</p>';
                $return .= '</label></div>';
                return $return;
            }
        ]
    )
    ->label(false);
?>
</div>
<div class="clearfix"></div>
<div class="col-xs-12" style="background-color: #fff; color: #18445a" align="left">
    <br>
    <div class="col-md-3 col-xs-6">
        <?= $form->field($model, 'auto_mark_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(AutoMark::find()->all(), 'id', 'name'),
            ['prompt'=>'Выберите марку',
                'onchange'=>'
                $.get( "lists?id="+$(this).val(), function( data ) {
                  $( "select#autos-auto_model_id" ).html( data );
                });
            '])->label('Марка'); ?>
    </div>
    <div class="col-md-3 col-xs-6">
        <? if ($model->auto_mark_id) { ?>
        <?= $form->field($model, 'auto_model_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(AutoModel::find()->where(['mark_id' => $model->auto_mark_id])->all(), 'id', 'name'),
            ['prompt'=>'Выберите модель'])->label('Модель'); ?>
        <?}else{?>
            <?= $form->field($model, 'auto_model_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(AutoModel::find()->all(), 'id', 'name'),
                ['prompt'=>'Выберите модель'])->label('Модель'); ?>
        <?}?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'auto_year')->dropDownList(
            ['2000' => '2000 г.',
                '2001' => '2001 г.',
                '2002' => '2002 г.',
                '2003' => '2003 г.',
                '2004' => '2004 г.',
                '2005' => '2005 г.',
                '2006' => '2006 г.',
                '2007' => '2007 г.',
                '2008' => '2008 г.',
                '2009' => '2009 г.',
                '2010' => '2010 г.',
                '2011' => '2011 г.',
                '2012' => '2012 г.',
                '2013' => '2013 г.',
                '2014' => '2014 г.',
                '2015' => '2015 г.',
                '2016' => '2016 г.',
                '2017' => '2017 г.',
            ]
        )->label('Год') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'auto_city')->textInput()->label('Город')->dropDownList(['Новосибирск' => 'Новосибирск', 'Бердск' => 'Бердск']) ?>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-9">
        <?= $form->field($model, 'auto_color')
            ->radioList(
                ['white'=>'Белый','silver'=>'Cеребристый','gray'=>'Серый','beige'=>'Бежевый','yellow'=>'Желтый','gold'=>'Золотой',
                    'orange'=>'Оранжевый','pink'=>'Розовый','red'=>'Красный','purple'=>'Пурпурный','brown'=>'Коричневый',
                    'blue'=>'Голубой','darkblue'=>'Синий','violet'=>'Фиолетовый','green'=>'Зеленый','black'=>'Черный'],
                [
                    'item' => function($index, $label, $name, $checked, $value) {
                        $check = $checked ? ' checked="checked"' : '';
                        $return = '<label class="color">';
                        $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3" '.$check.'>';
                        $return .= '<span style="background-color: '.$value.';" class="tooltips" data-original-title="' . ucwords($label) . '"></span>';
                        $return .= '</label>';
                        return $return;
                    }
                ]
            )
            ->label('Цвет кузова автомобиля');
        ?>
    </div>
    <div class="col-md-3" style="margin-left: -25px">
        <div class="form-group form-md-checkboxes">
            <label> </label>
            <div class="md-checkbox-list">
                <div class="md-checkbox">
                    <input type="checkbox" id="checkbox1" class="md-check" name="Autos[auto_damage]" value="1" >
                    <label for="checkbox1">
                        <span class="inc"></span>
                        <span class="check"></span>
                        <span class="box"></span> Есть повреждения <i class="fa fa-info-circle tooltips" style="color: #ccc;" data-original-title="Отметьте, если Ваш автомобиль имеет видимые повреждения" data-container="body"></i> </label>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <?= $form->field($model, 'auto_parking')->textarea(['rows' => 6])->label('Место стоянки автомобиля <i class="fa fa-info-circle tooltips" style="color: #ccc;" data-original-title="Например, гараж или парковка перед домом/работой." data-container="body"></i>') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'auto_comment')->textarea(['rows' => 6])->label('Другие комментарии <i class="fa fa-info-circle tooltips" style="color: #ccc;" data-original-title="Напишите о том, что считаете нужным. Например, как часто Вы моете машину." data-container="body"></i>') ?>
    </div>
<div class="row">
<div class="col-md-12">
    <div class="form-group">
        <?= Html::submitButton('Перейти к обозначению рекламных мест', ['class' => 'btn blue btn-block']) ?>
    </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>

