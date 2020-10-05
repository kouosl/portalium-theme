<?php
/**
 * @link http://www.diginova.com.tr/
 * @copyright Copyright (c) 2014 diginova 
 * @license http://www.diginova.com.tr/yii2-Theme.license
 */

namespace portalium\theme\bundles;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
   public $sourcePath = '@vendor/portalium/portalium-theme/src/assets/plugins/font-awesome/';

    public $css = [
    		'css/font-awesome.min.css',
    ];
}
