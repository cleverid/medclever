<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 19.07.15
 * Time: 11:54
 */

namespace frontend\widgets\PhotoSwipe;

use yii\web\AssetBundle;

class PhotoSwipeAssets extends AssetBundle {
    public $sourcePath = '@bower/photoswipe/dist';
    public $css = [
        'photoswipe.css',
        'default-skin/default-skin.css',
    ];
    public $js = [
        YII_ENV_DEV ? 'photoswipe.js' : 'photoswipe.min.js',
        YII_ENV_DEV ? 'photoswipe-ui-default.js' : 'photoswipe-ui-default.min.js',
    ];
}