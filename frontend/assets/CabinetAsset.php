<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CabinetAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        './layout/plugins/font-awesome/css/font-awesome.min.css',
        './layout/plugins/simple-line-icons/simple-line-icons.min.css',
        './layout/plugins/bootstrap/css/bootstrap.min.css',
        './layout/plugins/uniform/css/uniform.default.css',
        './layout/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        './layout/css/components.min.css',
        './layout/css/plugins.min.css',
        './layout/css/layout.min.css',
        './layout/css/themes/blue.min.css',
        './layout/css/custom.min.css',
    ];
    public $js = [
        './layout/scripts/jquery.min.js',
        './layout/plugins/bootstrap/js/bootstrap.min.js',
        './layout/scripts/app.min.js',
        './layout/plugins/jquery-slimscroll/jquery.slimscroll.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPlaginAsset'
    ];
}
