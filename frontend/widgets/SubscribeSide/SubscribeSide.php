<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 28.12.14
 * Time: 0:13
 */

namespace frontend\widgets\SubscribeSide;

class SubscribeSide extends \yii\base\Widget {

    public function run() {
        return false;
        echo $this->render("view");
    }

}