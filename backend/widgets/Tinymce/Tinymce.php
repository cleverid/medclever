<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 09.01.15
 * Time: 13:14
 */

namespace backend\widgets\Tinymce;


use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\web\View;

class Tinymce extends \letyii\tinymce\Tinymce {

    public function init() {
        parent::init();

        $this->registrScript();

        $this->configs = ArrayHelper::merge([
            'language' => 'ru',
            'menubar' => false,
            'plugins' => ["link", "image", "code", 'fullscreen'],
            'relative_urls' => true,
            'convert_urls' => false,
            'file_browser_callback' => new JsExpression("elFinderBrowser"),
            'toolbar' => [
                "undo redo | bold italic underline | alignleft aligncenter alignright | styleselect removeformat | link image | fullscreen code"
            ],
        ], $this->configs);

        $this->options = ArrayHelper::merge([
            'id' => uniqid(),
        ], $this->options);
    }

    private function registrScript(){
        $title = \Yii::t('app', "File manager");

        $script = <<< JS
            function elFinderBrowser (field_name, url, type, win) {
              tinymce.activeEditor.windowManager.open({
                file: '/index.php?r=elfinder/manager&callback=tinymce',// use an absolute path!
                title: "$title",
                width: 900,
                height: 450,
                resizable: 'yes'
              }, {
                setUrl: function (url) {
                  win.document.getElementById(field_name).value = url;
                }
              });

              return false;
            }
JS;

        $this->view->registerJs($script, View::POS_READY, __CLASS__);
    }

}