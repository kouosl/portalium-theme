<?php

namespace portalium\theme;

use Yii;
use yii\web\AssetBundle;
use yii\base\InvalidConfigException;
use portalium\theme\bundles\AppAsset;

class Theme extends \yii\base\Component
{
    public static $assetsBundle;
    
    /**
     * @var string Component name used in the application
     */
    public static $componentName = 'theme';
    
    /**
     * @return Theme Get Theme component
     */
    public static function getComponent()
    {
        return Yii::$app->{static::$componentName};
    }

    /**
     * Get base url to Theme assets
     * @param $view View
     * @return string
     */
    public static function getAssetsUrl($view)
    {
        if (static::$assetsBundle === null)
        {
            static::$assetsBundle = static::registerAppAsset($view);
        }

        return (static::$assetsBundle instanceof AssetBundle) ? static::$assetsBundle->baseUrl : '';
    }

    public static function registerAppAsset($view)
    {
    	return static::$assetsBundle = AppAsset::register($view);
    }
}
