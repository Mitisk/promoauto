<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\AutoMark;
use common\models\AutoModel;
use frontend\components\Words;

$this->title = 'Поиск';
$this->params['breadcrumbs'][] = ['label' => 'Автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="/./layout/css/addauto.css" rel="stylesheet">



<div class="autos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['search'],
        'method' => 'get',
    ]); ?>

    <div class="row" style="background-color: rgba(55,57,68,.9);color: #ffffff;margin: -20px;">
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
    </div>
    <div class="clearfix"></div>
    <div class="row" style="padding-top: 15px;">
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
    <div class="col-md-2 col-xs-4">
        <?= $form->field($model, 'auto_year')->dropDownList(
            [   Null =>' ',
                '2000' => '2000 г.',
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
    <div class="col-md-4 col-xs-8">
        <?= $form->field($model, 'auto_city')->textInput()->label('Город')->dropDownList([Null =>'город не выбран','Новосибирск' => 'Новосибирск', 'Бердск' => 'Бердск']) ?>
    </div>

        <div class="col-xs-12">
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
        <div class="col-md-11  col-xs-9">
            <?= Html::submitButton('<i class="fa fa-search"></i> Поиск', ['class' => 'btn green-sharp btn-outline btn-lg btn-block sbold uppercase']) ?>
        </div>
        <div class="col-md-1  col-xs-3">
            <?= Html::resetButton('<i class="fa fa-times"></i>', ['class' => 'btn btn-lg btn-default']) ?>
        </div>
        <div class="col-xs-12"><hr></div>
    </div>
    <?php ActiveForm::end(); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{items}\n<div align='center'>{pager}</div>",
        'columns' => [
            ['label' => 'Изображение',
                'format' => 'raw',
                'headerOptions' => ['width' => '120px'],
                'contentOptions' =>['align' => 'center'],
                'value' => function($data){
                    $image = \frontend\widgets\Auto::widget(['Auto_file_name' => $data->auto_id]);
                    return Html::img(Url::toRoute($image),[
                        'style' => 'width:100px;'
                    ]);
                },
            ],
            ['format' => 'raw',
            'label' => 'Имя',
                'value' => function($data){
                    if ($data->auto_vip) {
                        $star = '<i class="font-yellow-crusta glyphicon glyphicon-star-empty"></i>';
                    } else { $star = NULL; };
                    $fullnameauto = $star.' '.AutoMark::findOne($data->auto_mark_id)->name . ' ' . AutoModel::findOne($data->auto_model_id)->name.'<br><img src="/uploads/img/'.$data->auto_type.'.png" style="height: 30px;">';
                    return $fullnameauto;
                },
            ],
            [
                'attribute' => 'auto_city',
                'format' => 'text',
                'label' => 'Город',
            ],
            [
                'attribute' => 'auto_year',
                'format' => 'text',
                'label' => 'Год',
            ],
            ['label' => 'Цвет',
                'format' => 'raw',
                'headerOptions' => ['width' => '55'],
                'contentOptions' =>['align' => 'center'],
                'value' => function($data){
                    $color = '<label class="color"><span style="margin: 0;background-color: '.$data->auto_color.';" class="tooltips" data-original-title="'.Words::auto_color($data->auto_color).'"></span></label>';
                    return $color;
                },
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'headerOptions' => ['width' => '100px'],
                'contentOptions' =>['align' => 'center'],
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a('перейти', $url, ['class' => 'btn dark btn-outline sbold uppercase']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
