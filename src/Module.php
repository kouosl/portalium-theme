<?php
namespace portalium\theme;

use Yii;

class Module extends \portalium\base\Module
{

    public static function moduleInit()
    {
        self::registerTranslation('theme','@portalium/theme/messages',[
            'theme/theme' => 'theme.php',
        ]);
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('theme', $message, $params);
    }
}