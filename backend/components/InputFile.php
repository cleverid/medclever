<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 19.06.15
 * Time: 13:28
 */

namespace backend\components;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class InputFile extends \mihaildev\elfinder\InputFile {

    public $imageOptions = [];

    public function init() {

        $this->language = 'ru';
        $this->buttonName = Yii::t('app', 'Load');
        if(empty($this->controller)) {
            $this->controller = 'elfinder'; // вставляем название контроллера, по умолчанию равен elfinder
        }

        $this->options = ArrayHelper::merge([
            'class' => 'form-control',
        ], $this->options);
        if(empty($this->buttonOptions)) {
            $this->buttonOptions = ['class' => 'btn btn-default'];
        }

        parent::init();

        $this->template = <<<EOL
        <div class="container-fluid row">
            <div class="col-md-6 row">
                <div class="input-group">
                    {input}<span class="input-group-btn">{button}</span>
                </div>
            </div>
        </div>
        <div class="container-fluid row">
            <div class="elfinder-image-place col-md-6 row">{image}</div>
        </div>
EOL;
        $src = $this->model->{$this->attribute};
        $this->imageOptions = [
            'id' => $this->options['id']."_image",
            'style' => 'display: none',
        ];

        $this->registrScript();
    }

    public function run() {

        $replace = [];
        $replace['{image}'] = Html::img($this->model->{$this->attribute}, $this->imageOptions);
        $this->template = strtr($this->template, $replace);

        parent::run();
    }

    private function registrScript(){
        $idInput = $this->options['id'];
        $idImage = $this->imageOptions['id'];
        $delayUpdate = 1000;
        $script = <<<JS
            (function(){
                var input = $('#$idInput'),
                    image = $('#$idImage'),
                    oldValue = input.val()

                function ImageExist(url) {
                   var img = new Image();
                   img.src = url;

                   return img.height != 0;
                }

                function setImage(url) {
                    if(ImageExist(url)) {
                        image.attr('src', url);
                        image.show();
                    } else {
                        image.hide();
                    }
                }

                setInterval(function(){
                    var newValue = input.val();
                    if(newValue !== oldValue) {
                        oldValue = newValue;
                        setImage(newValue);
                    }
                }, $delayUpdate);

                setImage(oldValue);
            })();
JS;

        $this->getView()->registerJs($script);
    }

}