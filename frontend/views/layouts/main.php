<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '57x57', 'href' => '/apple-icon-57x57.png'])?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '60x60', 'href' => '/apple-icon-60x60.png'])?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '72x72', 'href' => '/apple-icon-72x72.png'])?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '72x72', 'href' => '/apple-icon-72x72.png'])?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '76x76', 'href' => '/apple-icon-76x76.png'])?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '114x114', 'href' => '/apple-icon-114x114.png'])?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '120x120', 'href' => '/apple-icon-120x120.png'])?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '144x144', 'href' => '/apple-icon-144x144.png'])?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '152x152', 'href' => '/apple-icon-152x152.png'])?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => '/apple-icon-180x180.png'])?>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '192x192', 'href' => '/android-icon-192x192.png'])?>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => '/favicon-32x32.png'])?>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '96x96', 'href' => '/favicon-96x96.png'])?>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => '/favicon-16x16.png'])?>
    <?php $this->registerLinkTag(['rel' => 'manifest', 'href' => '/manifest.json'])?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
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
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
