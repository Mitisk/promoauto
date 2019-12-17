<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<form role="form">
    <div class="form-group">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Логин') ?>
        <!--<input type="text" id="inputUsernameEmail" class="form-control">-->
    </div>
    <div class="form-group">
<?= Html::a('Забыли пароль?', ['site/request-password-reset', $options], ['class' => 'pull-right label-forgot']) ?>
        <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
        <!--<input type="password" id="inputPassword" class="form-control">-->
    </div>
    <div class="checkbox pull-left">
            <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>
    </div>
    <?= Html::submitButton('Вход', ['class' => 'btn btn btn-primary pull-right', 'name' => 'login-button']) ?>

</form>
<?php ActiveForm::end(); ?>
<a class="forgotLnk" href="index.html"></a>
<div class="or-box">

    <center><span class="text-center login-with">ИЛИ</span></center>

    <div style="margin-top:25px" class="row">
        <div class="col-md-6 row-block">
            <a href="index.html" class="btn btn-google btn-block"><span class="entypo-gplus space-icon"></span>Google +</a>
        </div>
        <div class="col-md-6 row-block">
            <a href="index.html" class="btn btn-google btn-block"><span class="entypo-gplus space-icon"></span>Google +</a>
        </div>
    </div>
</div>
<hr>
<div class="row-block">
    <div class="row">
        <div class="col-md-12 row-block">
            <a href="/site/signup" class="btn btn-primary btn-block">Создать новый аккаунт</a>
        </div>
    </div>
</div>