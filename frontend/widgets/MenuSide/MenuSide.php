<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 28.12.14
 * Time: 0:13
 */

namespace frontend\widgets\MenuSide;


class MenuSide extends \yii\base\Widget {

    public function init() {
    }

    public function run() {
        return $this->render('view', ['test' => 'test']);
    }

}