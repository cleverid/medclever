<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LockFixedAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'js/jquery.lockfixed.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public static function register($view)
    {
        $script = <<<EOL
            $.lockfixed(".social-side", {offset: {top: 0, bottom: 15}});
EOL;

        $view->registerJs($script, View::POS_END);
        return $view->registerAssetBundle(get_called_class());
    }

}
