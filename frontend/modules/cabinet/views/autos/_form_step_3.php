<?php
use common\models\AutoMark;
use common\models\AutoModel;
use Imagine\Image\Box;
use Imagine\Image\Point;
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
        .auto-image {
            max-width: 242px;
            height: 141px;
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
            <div class="col-md-4 mt-step-col last done">
                <div class="mt-step-number bg-white">3</div>
                <div class="mt-step-title uppercase font-grey-cascade">Фотографии</div>
                <div class="mt-step-content font-grey-cascade">загрузка фотографий</div>
            </div>
        </div>
    </div>


    <div class="col-xs-12">
    <br>
    <div style="background-color: #fff; color: #18445a;"><br>
        <div class="col-sm-12">
            Почти все закончено, осталось зарузить главную фотографию. В любое время Вы можете изменить ее.
            <br><br>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="thumbnail ">
                <div class="auto-image">
                    <img src="<?= \frontend\widgets\Auto::widget(['Auto_file_name' => $autoid]) ?>" alt="<?= AutoMark::findOne($myauto->auto_mark_id)->name; ?> <?= AutoModel::findOne($myauto->auto_model_id)->name; ?>" width="100%" class="">
                </div>
                <div class="caption">
                    <h3 align="center" style="cursor: pointer; text-shadow: none; color: #337ab7;"><?= AutoMark::findOne($myauto->auto_mark_id)->name; ?> <?= AutoModel::findOne($myauto->auto_model_id)->name; ?></h3>
                    <div align="center">
                        <span class="label label-default"><?= Yii::$app->formatter->asDate($myauto->auto_date, 'dd-MM-yyyy') ?></span>
                    </div>
                </div>
            </div>
        </div>

<?php $form = \yii\bootstrap\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="col-sm-6 col-md-8 col-lg-9">

            <?= $form->field($model, 'auto_image')->fileInput()->label(' ') ?>
        </div>
        <br>
        <div class="col-sm-12">
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn blue btn-block']) ?>
    </div>
        </div>
<?php \yii\bootstrap\ActiveForm::end(); ?>
        <div class="clearfix"></div>
    </div>
    </div>
    </div>
