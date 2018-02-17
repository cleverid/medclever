<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 28.12.14
 * Time: 0:13
 */

namespace frontend\widgets\SocialWeSide;

class SocialWeSide extends \yii\base\Widget {

    public function run() {
        echo $this->render("view");
    }

}