<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\AutoAdvertPlace;
/* @var $this yii\web\View */
/* @var $model common\models\Autos */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Добавление автомобиля';
$this->params['breadcrumbs'][] = ['label' => 'Автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <style type="text/css">
        .font-grey-cascade {
            color: #fff!important;
        }
    </style>
    <div class="row" style="background: url(/uploads/img/bg-add.jpg) round; margin: -19px -20px -10px -20px; ">
        <div class="mt-element-step">
            <div class="row step-line">
                <div class="col-md-4 mt-step-col first done">
                    <div class="mt-step-number bg-white">1</div>
                    <div class="mt-step-title uppercase font-grey-cascade">Описание</div>
                    <div class="mt-step-content font-grey-cascade">автомобиля</div>
                </div>
                <div class="col-md-4 mt-step-col done">
                    <div class="mt-step-number bg-white error">2</div>
                    <div class="mt-step-title uppercase font-grey-cascade">Реклама</div>
                    <div class="mt-step-content font-grey-cascade">стоимость и размещение</div>
                </div>
                <div class="col-md-4 mt-step-col last">
                    <div class="mt-step-number bg-white">3</div>
                    <div class="mt-step-title uppercase font-grey-cascade">Фотографии</div>
                    <div class="mt-step-content font-grey-cascade">загрузка фотографий</div>
                </div>
            </div>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-xs-12">
            <br>
            <div style="background-color: #fff; color: #18445a;">

                <div class="col-md-4 col-lg-5"><br>
                    <!-- BEGIN WIDGET THUMB -->
                    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                        <h4 class="widget-thumb-heading">помощь</h4>
                        <div style="text-transform:none">
                            <p>Перед Вами автомобиль, который похож на Ваш. Пожалуйста, укажите места, на которые Вы разрешаете разместить рекламные наклейки.</p>
                            <p>При нажатии на кнопку со значком <a class="btn btn-circle btn-icon-only btn-default"><i class="fa fa-cog"></i></a> откроется окно в котором необходимо указать цену.</p>
                            <p>При нажатии на кнопку со значком <a class="btn btn-circle btn-icon-only red-mint btn-default"><i class="fa fa-close"></i></a> ранее установленная цена будет удалена, а место станет недоступно для аренды рекламодателями.</p>
                            <p>Вы можете установить цену за полное брендирование автомобиля:</p>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount"></label>
                                <div class="input-group">
                                    <div class="input-group-addon">₽</div>
                                    <input type="text" id="autos-auto_price" class="form-control" name="Autos[auto_price]" placeholder="цена" size="5" template="{input}">
                                    <div class="input-group-addon">.00</div>
                                    <select id="autos-auto_price_for" class="form-control" name="Autos[auto_price_for]">
                                        <option value="за день">за день</option>
                                        <option value="за неделю">за неделю</option>
                                        <option value="за месяц">за месяц</option>
                                        <option value="за 100 км">за 100 км</option>
                                        <option value="за 500 км">за 500 км</option>
                                        <option value="за 1000 км">за 1 000 км</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET THUMB -->
                </div>

                <?if ($model->auto_type) {
                    echo $this->render('_g' . $model->auto_type, [
                        'model' => $model,
                        'id' => $id,
                        'view' => 'edit',
                        'modelview' => $model->auto_view
                    ]);
                }?>

                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="form-group" align="center"><br>
                        <?= Html::submitButton('Перейти к загрузке изображений', ['class' => 'btn blue btn-block']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>




