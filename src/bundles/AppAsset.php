<?php

namespace portalium\theme\bundles;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle {

    /**
     * @var string source assets path
     */
    public $sourcePath = '@portalium/theme/assets/apps/custom/';

    /**
     * @var array depended bundles
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @var array css assets
     */
    public $css = [
        'css/site.css',
        'css/custom.css'

    ];

    /**
     * @var array js assets
     */
    public $js = [
    ];

    public function init()
    {
        parent::init();
    }
}