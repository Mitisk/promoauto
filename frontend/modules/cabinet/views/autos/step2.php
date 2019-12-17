<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>


        <?
        echo $form->field($model, 'auto_image')->label('Главное изображение')->widget(\kartik\file\FileInput::classname(),[
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' => [
                'uploadUrl' => \yii\helpers\Url::to(['file-upload-general']),
                'uploadExtraData' => [
                    'advert_id' => $model->auto_id,
                ],
                'allowedFileExtensions' =>  ['jpg', 'png','gif'],
                'initialPreview' => $image,
                'showUpload' => true,
                'showRemove' => false,
                'dropZoneEnabled' => false
            ]
        ]);
        ?>


        <?
        echo \yii\helpers\Html::label('Другие изображения');

        echo \kartik\file\FileInput::widget([
            'name' => 'images',
            'options' => [
                'accept' => 'image/*',
                'multiple'=>true,

            ],
            'pluginOptions' => [
                'uploadUrl' => \yii\helpers\Url::to(['file-upload-images']),
                'uploadExtraData' => [
                    'advert_id' => $model->auto_id,
                ],
                'maxFileCount' => 3,
                'overwriteInitial' => false,
                'allowedFileExtensions' =>  ['jpg', 'png','gif'],
                'initialPreview' => $images_add,
                'showUpload' => true,
                'showRemove' => false,
                'dropZoneEnabled' => true
            ]
        ]);
        ?>
    <br><br>



    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

<?php \yii\bootstrap\ActiveForm::end(); ?>