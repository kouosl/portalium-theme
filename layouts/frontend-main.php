<?php

/* @var $this \yii\web\View */
/* @var $content string */

use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Nav;
use kouosl\theme\widgets\NavBar;
use kouosl\theme\widgets\Breadcrumbs;
use kouosl\theme\widgets\Alert;
use kouosl\theme\bundles\CustomAsset;
use \kouosl\theme\Module;
use \kouosl\site\models\Setting;

CustomAsset::register($this);

$languages = ['tr-TR' => 'Türkçe','en-US' => 'English'];
// $signup = Setting::findOne(['setting_key' =>  'signup']);
// $contact = Setting::findOne(['setting_key' =>  'contact']);
// $login = Setting::findOne(['setting_key' =>  'login']);
// $about = Setting::findOne(['setting_key' =>  'about']);
$settings = Setting::find()->asArray()->all();
foreach ($settings as $setting){
    $settings[$setting['setting_key']] = $setting['value'];
}

 $lang = yii::$app->session->get('lang');
// if(!$lang)
// $lang = 'en-US';

switch ($settings['language']) {
    case 'EN':
         $lang = 'en-US';
         break;
    case 'TR':
         $lang = 'tr-TR';
        break;
    default:
          $lang = 'en-US';
        break;
}
yii::$app->session->set('lang',$lang);

$activeLangLabel = $languages[$lang];
unset($languages[$lang]);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Module::t('theme','Home'), 'url' => ['/site/home']],
        
    ];
    if($settings['about'] === 'true')
         $menuItems[] = ['label' => Module::t('theme','About'), 'url' => ['/site/auth/about']];

    if($settings['contact'] === 'true')
      $menuItems[] =  ['label' => Module::t('theme','Contact'), 'url' => ['/site/auth/contact']];
    if (Yii::$app->user->isGuest) {
     
        if($settings['signup'] === 'true')
            $menuItems[] = ['label' => Module::t('theme','Sign Up'), 'url' => ['/site/auth/signup']];
        if($settings['login'] === 'true')
            $menuItems[] = ['label' => Module::t('theme','Login'), 'url' => ['/site/auth/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/auth/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    

    $langItems = [];
    foreach ($languages as $key => $value){
        $langItems[] = ['label' => $value, 'url' => ['/site/auth/lang','lang' => $key]];
    }
    $menuItems[] = ['label' => $activeLangLabel, 'url' => ['/site/auth/lang','lang' => $lang],
        'items' => $langItems,
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Kocaeli University Open Source Lab <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
