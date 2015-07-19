<?php
use frontend\widgets\MenuSide\MenuSide;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link rel="icon" type="image/png" href="/image/favicon_16х16.png" />
    <link rel="apple-touch-icon" href="/image/favicon_57х57.png"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrapper-content">

        <header class="header">
            <a href="/"
               alt="<?=Yii::$app->params['logoTagLine']?>">
                <div class="logo"></div>
            </a>
            <?if(0):?>
                <div class="search-box">
                    <form>
                        <input class="search-input" type="text" placeholder="Что ищите?"/>
                        <button class="btn-search"><i class="micon-search"></i></button>
                    </form>
                </div>
            <?endif;?>
        </header>

        <div class="column-left">
            <?= MenuSide::widget([])?>
        </div>
        <div class="column-center">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>

        <div style="clear: both"></div>
        <div class="footer-dummy"></div>
    </div>
    <div class="wrapper-content-foother">
        <footer class="footer">
            <div class="footer-copyright">© Физиолаб 2012-<?=date('Y')?></div>
            <div class="footer-menu">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="/kontakty">Контакты</a></li>
                    <li><a href="/about">О нас</a></li>
                </ul>
            </div>
        </footer>
    </div>

<?=\frontend\widgets\PhotoSwipe\PhotoSwipe::widget()?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

