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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/png" href="/image/favicon_16х16.png" />
    <link rel="apple-touch-icon" href="/image/favicon_57х57.png"/>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrapper-content">

        <header class="header">
            <a href="/"
               alt="<?=Yii::$app->params['logoTagLine']?>">
                <div class="logo"></div>
            </a>
            <div class="search-box">
                <form>
                    <input class="search-input" type="text" placeholder="Что ищите?"/>
                    <button class="btn-search"><i class="micon-search"></i></button>
                </form>
            </div>
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

        </footer>
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
