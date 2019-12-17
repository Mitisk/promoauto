<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Campaign */
/* @var $form yii\widgets\ActiveForm */
?>
<link href="/./layout/css/pricing.min.css" rel="stylesheet">

<div class="col-xs-12">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control input-lg'])->label('
    <h4>Название <i class="tooltips" data-container="body" data-placement="right" data-original-title="Название рекламной кампании никто не сможет увидеть кроме Вас."><i class="fa fa-question-circle"></i></i></h4>
    ') ?>
        <br>
        <div class="note note-info">
            <h4 class="block">Выберите тариф</h4>
            <p> Выберите тарифный план для рекламной кампании. Тарифный план един для создаваемой кампании, его нельзя поменять. </p>
        </div>
        <br>

    <div class="pricing-content-1">
        <div class="row">
            <div class="col-md-4">
                <div class="price-column-container border-active">
                    <div class="price-table-head bg-red">
                        <h2 class="no-margin">Создать макет</h2>
                    </div>
                    <div class="arrow-down border-top-red"></div>
                    <div class="price-table-pricing">
                        <h3>
                            <span class="price-sign" style="margin-left: -25px;margin-top: 35px;">от</span>
                            <span class="price-sign" style="margin-left: 110px;"><i class="fa fa-rub" aria-hidden="true"></i></span><?=$tariff1_price?>
                        </h3>
                        <p>за единицу</p>
                        <div class="price-ribbon" style="width: 107px; text-transform: none;">популярный</div>
                    </div>
                    <div class="price-table-content" style="padding: 19px; text-align: left;">
                        Вы пишете рекламный текст, а мы печатаем и отправляем его владельцам выбранных автомобилей.
                    </div>
                    <div class="arrow-down arrow-grey"></div>
                    <div class="price-table-footer">
                        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['value'=>'tariff1', 'name'=>'submit', 'class' => 'btn green price-button sbold uppercase']) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="price-column-container border-active">
                    <div class="price-table-head bg-purple">
                        <h2 class="no-margin">Есть макет</h2>
                    </div>
                    <div class="arrow-down border-top-purple"></div>
                    <div class="price-table-pricing">
                        <h3>
                            <span class="price-sign" style="margin-left: -25px;margin-top: 35px;">от</span>
                            <span class="price-sign" style="margin-left: 110px;"><i class="fa fa-rub" aria-hidden="true"></i></span><?=$tariff2_price?></h3>
                        <p>за единицу</p>
                    </div>
                    <div class="price-table-content" style="padding: 19px; text-align: left;">
                        У Вас уже есть готовый макет, который нужно распечатать. Мы печатаем и отправляем автовладельцам.
                    </div>
                    <div class="arrow-down arrow-grey"></div>
                    <div class="price-table-footer">
                        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['value'=>'tariff2', 'name'=>'submit', 'class' => 'btn grey-salsa btn-outline price-button sbold uppercase']) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="price-column-container border-active">
                    <div class="price-table-head bg-green">
                        <h2 class="no-margin">Все готово</h2>
                    </div>
                    <div class="arrow-down border-top-green"></div>
                    <div class="price-table-pricing">
                        <h3>
                            <span class="price-sign" style="margin-left: -25px;margin-top: 35px;">от</span>
                            <span class="price-sign" style="margin-left: 110px;"><i class="fa fa-rub" aria-hidden="true"></i></span><?=$tariff3_price?></h3>
                        <p>за единицу при пересылке</p>
                    </div>
                    <div class="price-table-content" style="padding: 19px; text-align: left;">
                        У Вас готовы все рекламные материалы. Мы их забираем и отправляем влаельцам выбранных автосредств.
                    </div>
                    <div class="arrow-down arrow-grey"></div>
                    <div class="price-table-footer">
                        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['value'=>'tariff3', 'name'=>'submit', 'class' => 'btn grey-salsa btn-outline price-button sbold uppercase']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <br><br>
</div>

