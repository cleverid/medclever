<?php

namespace backend\components\elfinder;

use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;


/**
 * Class Controller
 * @package mihaildev\elfinder
 * @property array $options
 */
class Controller extends \mihaildev\elfinder\Controller {

    public function actionManager(){

        $options = [
            'url'=> Url::toRoute('connect'),
            'customData' => [
                Yii::$app->request->csrfParam => Yii::$app->request->csrfToken
            ],
            'resizable' => false
        ];

        if(isset($_GET['CKEditor'])){
            $options['getFileCallback'] = new JsExpression('function(file){ '.
                'window.opener.CKEDITOR.tools.callFunction('.Json::encode($_GET['CKEditorFuncNum']).', file.url); '.
                'window.close(); }');

            $options['lang'] = $_GET['langCode'];
        }

        if(isset($_GET['filter'])){
            if(is_array($_GET['filter']))
                $options['onlyMimes'] = $_GET['filter'];
            else
                $options['onlyMimes'] = [$_GET['filter']];
        }

        if(isset($_GET['lang']))
            $options['lang'] = $_GET['lang'];

        if(isset($_GET['callback'])){
            if(isset($_GET['multiple']))
                $options['commandsOptions']['getfile']['multiple'] = true;

            if($_GET['callback'] == "tinymce" ) {
                $options['getFileCallback'] = $this->getCallbackForTinyMce();
            } else {
                $options['getFileCallback'] = new JsExpression('function(file){ '.
                    'if (window!=window.top) {var parent = window.parent;}else{var parent = window.opener;}'.
                    'if(parent.mihaildev.elFinder.callFunction('.Json::encode($_GET['callback']).', file))'.
                    'window.close(); }');
            }
        }

        if(!isset($options['lang']))
            $options['lang'] = Yii::$app->language;

        if(!empty($this->disabledCommands))
            $options['commands'] = new JsExpression('ElFinderGetCommands('.Json::encode($this->disabledCommands).')');



        return $this->renderFile(Yii::getAlias("@vendor")."/mihaildev/yii2-elfinder/views/manager.php", ['options'=>$options]);
    }

    /**
     * @return JsExpression
     */
    private function getCallbackForTinyMce(){
        $script = "
        function(file) {
            parent.tinymce.activeEditor.windowManager.getParams().setUrl(file.url);
            parent.tinymce.activeEditor.windowManager.close();
        }
        ";

        return new JsExpression($script);
    }

}
