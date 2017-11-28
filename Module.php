<?php

namespace kouosl\theme;

use Yii;


/**
 * Module [[Theme]]
 * Yii2 theme module.
 */
class Module extends \yii\base\Module
{
    //public $controllerNamespace = 'kouosl\theme\controllers\backend';


    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }


    public function registerTranslations()
    {
        Yii::$app->i18n->translations['theme/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@kouosl/theme/messages',
            'fileMap' => [
                'theme/theme' => 'theme.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        Yii::$app->i18n->translations['theme/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@kouosl/theme/messages',
            'fileMap' => [
                'theme/theme' => 'theme.php',
            ],
        ];

        return Yii::t('theme/' . $category, $message, $params, $language);
    }


}
