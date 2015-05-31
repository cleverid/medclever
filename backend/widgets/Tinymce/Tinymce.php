<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 09.01.15
 * Time: 13:14
 */

namespace backend\widgets\Tinymce;


use yii\helpers\ArrayHelper;

class Tinymce extends \letyii\tinymce\Tinymce {

    public function init() {
        parent::init();

        $this->configs = ArrayHelper::merge([
            'language' => 'ru',
            'menubar' => false,
            'plugins' => ["link", "image", "code", 'fullscreen'],
            'toolbar' => [
                "undo redo | bold italic underline | alignleft aligncenter alignright | styleselect removeformat | link image | fullscreen code"
            ],
        ], $this->configs);

        $this->options = ArrayHelper::merge([
            'id' => uniqid(),
        ], $this->options);
    }

}