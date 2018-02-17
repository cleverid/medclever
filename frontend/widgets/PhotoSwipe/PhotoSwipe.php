<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 19.07.15
 * Time: 11:41
 */

namespace frontend\widgets\PhotoSwipe;

use yii\web\View;

class PhotoSwipe extends \yii\base\Widget {

    public function init() {
        parent::init();

        PhotoSwipeAssets::register($this->view);
        $this->registrScript();
    }

    /**
     * @inheritDoc
     */
    public function run() {
        parent::run();

        return $this->render('view');
    }

    private function registrScript() {
        list($path, $webPath) = \Yii::$app->getAssetManager()->publish(__DIR__."/assets");
        $this->view->registerJsFile($webPath.'/photoswipe_init.js', [
            'depends' => \frontend\widgets\PhotoSwipe\PhotoSwipeAssets::className()
        ]);

        $js = <<<JS
            var psg = new PhotoSwipeGallery('.gallery-item');
            psg.init();
JS;

        $this->view->registerJs($js, View::POS_READY, __CLASS__);
    }

}