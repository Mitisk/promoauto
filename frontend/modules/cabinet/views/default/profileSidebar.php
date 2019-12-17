<?php
use yii\widgets\Menu;
use kartik\icons\Icon;
?>

<link href="/../layout/css/themes/profile.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PROFILE SIDEBAR -->

<div class="profile-sidebar">
    <!-- PORTLET MAIN -->
    <div class="portlet light profile-sidebar-portlet ">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            <?= \frontend\widgets\Avatar::widget() ?>
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> <?= (\Yii::$app->user->identity->name ? \Yii::$app->user->identity->name.' '.\Yii::$app->user->identity->surname : \Yii::$app->user->identity->username)?> </div>
            <div class="profile-usertitle-job"> <?= Yii::$app->user->identity->role ?> </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
                <?= Menu::widget([
                    'options' => ['class' => 'nav'],
                    'items' => [
                        ['label' => Icon::show('home') . 'Аккаунт', 'url' => ['default/index']],
                        ['label' => Icon::show('cog') . 'Редактировать', 'url' => ['profile/index']],
                        ['label' => Icon::show('info') . 'Помощь', 'url' => ['/support']],
                    ],
                    'activeCssClass' => 'active',
                    'encodeLabels' => false,
                ]);
                ?>
        </div>
        <!-- END MENU -->
    </div>
    <!-- END PORTLET MAIN -->
</div>
