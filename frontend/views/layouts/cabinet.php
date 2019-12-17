<?php
use yii\helpers\Html;
use frontend\assets\CabinetAsset;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use common\models\Notification;
use app\modules\User;
$user = \Yii::$app->user;

CabinetAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<?php $this->beginBody() ?>
<body class="page-sidebar-closed-hide-logo page-content-white page-full-width page-boxed page-header-fixed">

<div class="page-header navbar navbar-fixed-top">

    <div class="page-header-inner container">

        <div class="page-logo">
            <a href="<?= Yii::$app->user->isGuest ? Url::toRoute('/site/index') : Url::toRoute('/cabinet/default/index') ?>">
                <img src="<?= Url::toRoute('/layout/img/logo.png')?>" alt="logo" class="logo-default"> </a>
        </div>

        <div class="hor-menu   hidden-sm hidden-xs">
            <ul class="nav navbar-nav">

                <? if (Yii::$app->user->isGuest) {?>
                    <li class="classic-menu-dropdown">
                        <a href="<?= Url::toRoute('/login/index')?>">
                            <i class="icon-lock"></i> Вход
                        </a>
                    </li>
                    <li class="classic-menu-dropdown">
                        <a href="<?= Url::toRoute('site/signup')?>"><i class="icon-note"></i> Регистрация</a>
                    </li>
                <?} else {?>

                <li class="classic-menu-dropdown">
                    <a href="<?= Url::toRoute('/cabinet/autos')?>">Автомобили</a>
                </li>
                <li class="classic-menu-dropdown">
                    <a href="<?= Url::toRoute('/cabinet/campaign')?>">Реклама</a>
                </li>
                <li class="classic-menu-dropdown">
                    <a href="<?= Url::toRoute('/cabinet/coupon')?>">Купоны</a>
                </li>
                <?}?>

            </ul>
        </div>

        <a href="" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

    <?if (!Yii::$app->user->isGuest) {?>
                <?= \frontend\widgets\Notifications::widget() ?>
                <?= \frontend\widgets\Messages::widget() ?>

                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <?= \frontend\widgets\Avatar::widget() ?>
                        <span class="username username-hide-on-mobile"> Здравтвуйте,
                            <?= ($user->identity->name ? $user->identity->name : $user->identity->username)?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?= Url::toRoute('/cabinet/default/index')?>">
                                <i class="icon-user"></i> Профиль </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('/notification')?>">
                                <i class="icon-envelope-open"></i> Уведомления
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::toRoute('task/index')?>">
                                <i class="icon-rocket"></i> Задания
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="<?= Url::to(['../site/logout'])?>" data-method="post">
                                <i class="icon-key"></i> Выход </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="<?= Url::toRoute('/support')?>" class="dropdown-toggle">
                        <i class="icon-logout"></i>
                    </a>
                </li>

<?}?>

            </ul>
        </div>

    </div>

</div>

<div class="clearfix"> </div><div class="container"><div class="page-container">
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="min-height:336px">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <?php
                    echo Breadcrumbs::widget([
                        'itemTemplate' => "<li>{link} <i class=\"fa fa-circle\"></i></li>\n",
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'page-breadcrumb'
                        ],
                    ]);
                    ?>
                </div>
                <!-- END PAGE BAR -->
                <!-- END PAGE HEADER-->
                <?= '<br>'.Alert::widget() ?>
                <?= $content ?>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->

    </div><div class="page-footer">
        <div class="page-footer-inner"> <?= date('Y') ?> &copy; ПромоАвто.</div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->

<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->

<!-- END FOOTER -->

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>