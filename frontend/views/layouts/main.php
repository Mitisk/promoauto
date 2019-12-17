<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);

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



                <ul style="margin-right:0;" class="nav navbar-nav navbar-right">
                    <li>
                        <a href="./login/index/"><span class="icon-gear"></span>&#160;&#160;Вход</a>
                    </li>
                    <li>
                        <a href="./signup"><span class="icon-gear"></span>&#160;&#160;Регистрация</a>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- /END OF TOP NAVBAR -->





    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">



            <div class="content-wrap">
                <div class="row">


                    <div class="col-sm-12">
                        <!-- BLANK PAGE-->

                        <div class="nest" id="Blank_PageClose">

                            <div class="body-nest" id="Blank_Page_Content">

                                <?= Alert::widget() ?>
                                <?= $content ?>
                            </div>
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