<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\CabinetAsset;
use common\widgets\Alert;
use yii\helpers\Url;

use app\modules\User;
$user = \Yii::$app->user;

CabinetAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.js"></script>
        <script type="text/javascript">
            $(".topnav").accordionze({
                accordionze: true,
                speed: 500,
                closedSign: '<img src="http://promoa.loc/assets/img/plus.png">',
                openedSign: '<img src="http://promoa.loc/assets/img/minus.png">'
            });
            paceOptions = {
                ajax: false, // disabled
                document: false, // disabled
                eventLag: false, // disabled
                elements: {
                    selectors: ['.my-page']
                }
            };
            $(document).ready(function() {
                var mySlidebars = new $.slidebars();

                $('.toggle-left').on('click', function() {
                    mySlidebars.toggle('right');
                });
            });
        </script>
    </head>
    <?php $this->beginBody() ?>
    <body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->
    <nav role="navigation" class="navbar navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="entypo-menu"></span>
                </button>

                <div id="logo-mobile" class="visible-xs">
                    <h1>промоавто</h1>
                </div>

            </div>

            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <li class="dropdown">

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i style="font-size:20px;" class="icon-conversation"></i><div class="noft-red">23</div></a>


                        <ul style="margin: 11px 0 0 9px;" role="menu" class="dropdown-menu dropdown-wrap">
                            <li>
                                <a href="#">
                                    <img alt="" class="img-msg img-circle" src="http://api.randomuser.me/portraits/thumb/men/1.jpg">Петр <b>сейчас</b>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div>Все сообщения</div>
                            </li>
                        </ul>
                    </li>
                    <li>

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i style="font-size:19px;" class="icon-warning tooltitle"></i><div class="noft-green">5</div></a>
                        <ul style="margin: 12px 0 0 0;" role="menu" class="dropdown-menu dropdown-wrap">
                            <li>
                                <a href="#">
                                    <span style="background:#DF2135" class="noft-icon maki-bus"></span><i>Уведомление</i>  <b>1</b>
                                </a>
                            </li>
                            <li class="divider"></li>

                            <li>
                                <div>Все уведомления</div>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i data-toggle="tooltip" data-placement="bottom" title="Help" style="font-size:20px;" class="icon-help tooltitle"></i></a>
                    </li>

                </ul>


                <ul style="margin-right:0;" class="nav navbar-nav navbar-right">
                    <li>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" class="admin-pic img-circle" src="http://api.randomuser.me/portraits/thumb/men/10.jpg">
                            Здравтвуйте,
                            <?= ($user->identity->name ? $user->identity->name : $user->identity->username)?>
                            <b class="caret"></b>
                        </a>
                        <ul style="margin-top:14px;" role="menu" class="dropdown-setting dropdown-menu">
                            <li>
                                <a href="<?= Url::toRoute('/cabinet/default/index')?>">
                                    <span class="entypo-user"></span>&#160;&#160;Профиль</a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="entypo-vcard"></span>&#160;&#160;Настройки</a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="entypo-lifebuoy"></span>&#160;&#160;Помощь</a>
                            </li>
                            <li class="divider"></li>

                            <li><a href="<?= Url::to(['../site/logout'])?>" data-method="post">Выход</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="#"><span class="icon-gear"></span>&#160;&#160;Настройки</a>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->
    <div id="skin-select">
        <div id="logo">
            <h1>промоавто</h1>
        </div>

        <a id="toggle">
            <span class="entypo-menu"></span>
        </a>


        <div class="skin-part">
            <div id="tree-wrap">
                <div class="side-bar">
                    <ul class="topnav menu-left-nest">



                        <li>
                            <a class="tooltip-tip ajax-load" href="<?= Url::toRoute('/cabinet/default/index')?>" title="Профиль">
                                <i class="icon-document-edit"></i>
                                <span>Профиль</span>
                                <div class="noft-blue">289</div>
                            </a>
                        </li>
                        <li>
                            <a class="tooltip-tip ajax-load" href="<?= Url::toRoute('/cabinet/autos')?>" title="Автомобили">
                                <i class="icon-document-edit"></i>
                                <span>Мои автомобили</span>
                            </a>
                        </li>

                    </ul>

                    <div class="side-dash">
                        <h3><span>Баланс</span></h3>
                        <ul class="side-dashh-list">
                            <li>Заработано
                                <span>1 000 ₽</span>
                            </li>
                            <li>В ожидании
                                <span>1 000 ₽</span>
                            </li>
                            <li>Итого
                                <span>2 000 ₽</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF SIDE MENU -->



    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">





            <!-- CONTENT -->
            <!--TITLE -->
            <div class="row">
                <div id="paper-top">

                    <div class="col-sm-10">
                        <div class="devider-vertical visible-lg"></div>
                        <?=$this->render("//common/profileAlert") ?>

                    </div>

                    <div class="col-sm-2">
                        <div class="devider-vertical visible-lg"></div>
                        <div class="btn-group btn-wigdet pull-right visible-lg">
                            <div class="btn">
                                Виджет?</div>
                            <button data-toggle="dropdown" class="btn dropdown-toggle" type="button">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul role="menu" class="dropdown-menu">
                                <li>
                                    <a href="#">
                                        <span class="entypo-plus-circled margin-iconic"></span>Добавить</a>
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
            <!--/ TITLE -->

            <div class="content-wrap">
                <div class="row">


                    <div class="col-sm-12">

                            <div class="body-nest" id="Blank_Page_Content">

                                <?= Alert::widget() ?>
                                <?= $content ?>
                            </div>
                    </div>
                    <!-- END OF BLANK PAGE -->


                </div>



                <!-- /END OF CONTENT -->



                <!-- FOOTER -->
                <div class="footer-space"></div>
                <div id="footer">
                    <div class="devider-footer-left"></div>
                    <div class="time">
                        <p id="spanDate"></p>
                        <p id="clock"></p>
                    </div>
                    <div class="copyright">
                        <?= date('Y') ?> <?= Yii::powered() ?>
                    </div>
                    <div class="devider-footer"></div>

                </div>
                <!-- / END OF FOOTER -->


            </div>
        </div>
        <!--  END OF PAPER WRAP -->


        <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>