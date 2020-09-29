<?php

namespace portalium\theme\bundles;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@portalium/theme/assets/apps/custom/';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'portalium\theme\bundles\FontAwesomeAsset',
    ];

    public $css = [
        'css/site.css',
        'css/custom.css'

    ];

    public $js = [
    ];

    public function init()
    {
        parent::init();
    }
}
