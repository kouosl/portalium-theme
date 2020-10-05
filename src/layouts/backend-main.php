<?php

use yii\helpers\ArrayHelper;
use portalium\theme\helpers\Html;
use portalium\theme\widgets\Nav;
use portalium\theme\widgets\NavBar;
use portalium\theme\widgets\Breadcrumbs;
use portalium\theme\widgets\Alert;
use portalium\theme\bundles\AppAsset;
use portalium\theme\Module;
use portalium\theme\Theme;
use portalium\site\models\Setting;

Theme::registerAppAsset($this);

$settings   = ArrayHelper::map(Setting::find()->asArray()->all(),'name','value');
$languages  = json_decode(Setting::findOne(['name' => 'app::language'])->config,true);

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
        'brandLabel' => Html::encode($settings['app::title']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems [] = ['label' => Module::t('Home'), 'url' => ['/site/home']];

    if(!Yii::$app->user->isGuest)
        $menuItems [] = [
            'label' => Module::t('Settings'),
            'url' => ['/site/setting']
        ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => Module::t('Login'),
            'url' => ['/site/auth/login']
        ];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/auth/logout'], 'post')
            . Html::submitButton(
                Module::t('Logout'). ' (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    $langItems = [];

    foreach ($languages as $key => $value){
        $langItems[] = [
            'label' => Module::t($value),
            'url' => ['/site/home/lang','lang' => $key]
        ];
    }

    $menuItems[] = [
        'label' => Module::t($languages[Yii::$app->language]),
        'url' => ['/site/home/lang','lang' => Yii::$app->language],
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
        <p class="pull-left">&copy; Portalium <?= date('Y') ?></p>
        <p class="pull-right">DigiNova</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
