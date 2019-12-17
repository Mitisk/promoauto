<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'assets/css/style.css',
        'assets/css/loader-style.css',
        'assets/js/button/ladda/ladda.min.css'
    ];
    public $js = [
        'assets/js/preloader.js',
        'assets/js/app.js',
        'assets/js/load.js',
        'assets/js/main.js',
        'assets/js/bootstrap.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPlaginAsset'
    ];
}
