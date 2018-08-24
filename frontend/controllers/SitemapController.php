<?php
namespace frontend\controllers;
use Carbon\Carbon;
use common\components\SiteMap\SiteMap;
use common\models\Post;

/**
 * Site controller
 */
class SitemapController extends Controller
{

    public function actionIndex()
    {
        $classes = array(
            Post::className() => array(Sitemap::DAILY, 0.8),
        );

        /** @var Post $lastPost */
        $lastPost = Post::find()->orderBy(['updated_at' => SORT_DESC])->one();
        $hostName = \Yii::$app->params['shemaSite']
            . \Yii::$app->params['domenSite'];

        $sitemap = new Sitemap();
        $sitemap->addUrl(
            $hostName,
            SiteMap::DAILY,
            1,
            $sitemap->dateToW3C($lastPost->updated_at)
        );
        $sitemap->addUrl(
            rtrim($hostName, "/") . \Yii::$app->urlManager->createUrl("/library"),
            SiteMap::WEEKLY,
            0.5,
            Carbon::now()->startOfWeek()->toW3cString()
        );

        foreach ($classes as $class=>$options) {
            $sitemap->addModels($class::find()->published()->all(), $options[0], $options[1]);
        }

        //set content type xml in response
        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = \Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');

        echo $sitemap->render();

        \Yii::$app->end();
    }

}
