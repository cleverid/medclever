<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 31.05.15
 * Time: 15:09
 */

namespace common\components;


use Yii;

class Application extends \yii\web\Application {

    /**
     * @return string
     */
    public function getUrlFrontend(){
        return Yii::$app->params['shemaSite'].Yii::$app->params['domenSite'];
    }

}