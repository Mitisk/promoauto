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
                            ['label' => 'Информация', 'options' => ['class' => 'active'], 'url' => ['index']],
                            ['label' => 'Аватар', 'url' => ['avatar']],
                            ['label' => 'Пароль', 'url' => ['password']],
                            ['label' => 'Приватность', 'url' => ['privacy']],
                        ],
                        'activeCssClass' => 'active',
                    ]);
                    ?>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">

                        <!-- PERSONAL INFO TAB -->
                        <div class="tab-pane active" id="tab_1_1">
                            <?php $form = ActiveForm::begin(); ?>
                            <?= $form->field($model, 'name')->textInput()->label('Имя') ?>
                            <?= $form->field($model, 'middlename')->textInput()->label('Отчество') ?>
                            <?= $form->field($model, 'surname')->textInput()->label('Фамилия') ?>
                            <div class="col-md-6">
                            <?= $form->field($model, 'phone', ['template'=>'{label}<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>{input}</div>{hint}{error}'])->textInput()->label('Телефон') ?>
                            </div>
                            <div class="col-md-6">
                            <?= $form->field($model, 'email', ['template'=>'{label}<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>{input}</div>{hint}{error}'])->input('email')->label('Электронная почта') ?>
                            </div>


                            <div class="margin-top-10">
                                <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>

                        <!-- END PERSONAL INFO TAB -->
                        <!-- CHANGE AVATAR TAB -->

                        <div class="tab-pane" id="tab_1_2">
                            <p> Загрузите Вашу фотографию. </p>
                            <form action="#" role="form">
                                <div class="form-group">
                                    <?= $form->field($model, 'image')->fileInput() ?>


                                    <div class="clearfix margin-top-10">
                                        <span class="label label-danger">Внимание!</span>
                                        <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                    </div>
                                </div>
                                <div class="margin-top-10">
                                    <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
                                </div>
                            </form>
                        </div>
                        <!-- END CHANGE AVATAR TAB -->
                        <!-- CHANGE PASSWORD TAB -->
                        <div class="tab-pane" id="tab_1_3">

                            <form action="#">
                                <div class="form-group">
                                    <label class="control-label">Current Password</label>
                                    <input type="password" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">New Password</label>
                                    <input type="password" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Re-type New Password</label>
                                    <input type="password" class="form-control" /> </div>
                                <div class="margin-top-10">
                                    <a href="javascript:;" class="btn green"> Change Password </a>
                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                </div>
                            </form>
                        </div>
                        <!-- END CHANGE PASSWORD TAB -->
                        <!-- PRIVACY SETTINGS TAB -->
                        <div class="tab-pane" id="tab_1_4">
                            <form action="#">
                                <table class="table table-light table-hover">
                                    <tr>
                                        <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                        <td>
                                            <label class="uniform-inline">
                                                <input type="radio" name="optionsRadios1" value="option1" /> Yes </label>
                                            <label class="uniform-inline">
                                                <input type="radio" name="optionsRadios1" value="option2" checked/> No </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                        <td>
                                            <label class="uniform-inline">
                                                <input type="checkbox" value="" /> Yes </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                        <td>
                                            <label class="uniform-inline">
                                                <input type="checkbox" value="" /> Yes </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                        <td>
                                            <label class="uniform-inline">
                                                <input type="checkbox" value="" /> Yes </label>
                                        </td>
                                    </tr>
                                </table>
                                <!--end profile-settings-->
                                <div class="margin-top-10">

                                        <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>

                                </div>
                            </form>
                        </div>
                        <!-- END PRIVACY SETTINGS TAB -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- END PROFILE CONTENT -->
