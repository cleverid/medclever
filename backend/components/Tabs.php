<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 31.05.15
 * Time: 14:40
 */

namespace backend\components;


class Tabs extends \yii\bootstrap\Tabs {

    public function init() {
        $this->itemOptions['style'] = 'padding-top: 15px;';

        parent::init();
    }

}