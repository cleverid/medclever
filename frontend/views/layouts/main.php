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
            Шапка
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

        <div class="column-right">
            <?= \frontend\widgets\BannerSide\BannerSide::widget()?>
            <?= \frontend\widgets\SubscribeSide\SubscribeSide::widget()?>
            <?= \frontend\widgets\SocialWeSide\SocialWeSide::widget()?>
        </div>
        <div class="column-center">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
            <?= \frontend\widgets\SocialShare\SocialShare::widget()?>
        </div>

        <div style="clear: both"></div>
        <div class="footer-dummy"></div>
    </div>
    <div class="wrapper-content-foother">
        <footer class="footer">
            Редакция сайта: <a href="mailto:info@medclever.com">info@medclever.com</a>
        </footer>
    </div>

    <?=\frontend\widgets\PhotoSwipe\PhotoSwipe::widget()?>

    <?if(Yii::$app->params['webanalitics']):?>
        <!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter32884930 = new Ya.Metrika({ id:32884930, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/32884930" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
    <?endif;?>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

