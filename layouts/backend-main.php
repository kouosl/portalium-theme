<?php

/* @var $this \yii\web\View */
/* @var $content string */

use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Nav;
use kouosl\theme\widgets\NavBar;
use kouosl\theme\widgets\Breadcrumbs;
use kouosl\theme\widgets\Alert;
use kouosl\theme\bundles\CustomAsset;

CustomAsset::register($this);

$languages = ['tr-TR' => 'Türkçe','en-US' => 'English'];

$lang = yii::$app->session->get('lang');
if(!$lang)
    $lang = 'en-US';

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
        ['label' => 'Home', 'url' => ['/site/home']],
        ['label' => 'Sample', 'url' => ['/sample/samples/index'],
            'items' => [
                    ['label' => 'Create', 'url' => ['/sample/samples/create']],
                    ['label' => 'Manage', 'url' => ['/sample/samples/index']]
            ]
        ],
        ['label' => 'Menu', 'url' => ['/menu/menu/index'],
            'items' => [
                    ['label' => 'Create', 'url' => ['/menu/menu/create']],
                    ['label' => 'Manage', 'url' => ['/menu/menu/index']]
            ]
        ],
        ['label' => 'Settings', 'url' => ['/site/setting']],

    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/auth/login']];
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
