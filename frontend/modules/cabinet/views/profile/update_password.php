<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Menu;

$this->title = 'Промоавто - реклама на автомобилях в Новосибирске';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет пользователя', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование профиля';
?>
<?=$this->render("/default/profileSidebar") ?>

<!-- BEGIN PROFILE CONTENT -->
<div class="profile-content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Редактирование</span>
                    </div>
                    <?= Menu::widget([
                        'options' => ['class' => 'nav nav-tabs'],
                        'items' => [
                            ['label' => 'Информация', 'url' => ['index']],
                            ['label' => 'Аватар', 'url' => ['avatar']],
                            ['label' => 'Пароль', 'options' => ['class' => 'active'], 'url' => ['password']],
                            ['label' => 'Приватность', 'url' => ['privacy']],
                        ],
                        'activeCssClass' => 'active',
                    ]);
                    ?>
                </div>
                <div class="portlet-body">


                        <?php $form = ActiveForm::begin(); ?>
                            <div class="form-group">
                                    <?=$form->field($model, 'password')->passwordInput()->label('Текущий пароль')?> </div>
                                <div class="form-group">
                                    <?=$form->field($model, 'newpassword')->passwordInput()->label('Новый пароль')?> </div>
                                <div class="form-group">
                                    <?=$form->field($model, 'repassword')->passwordInput()->label('Повторите пароль')?> </div>
                            <div class="margin-top-10">
                                <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- END PROFILE CONTENT -->
