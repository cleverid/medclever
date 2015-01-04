<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 04.01.15
 * Time: 13:15
 */

namespace frontend\controllers;

use frontend\models\interfaces\ISEO;
use yii\web\View;

class Controller extends \yii\web\Controller {

    public $seoTitle, $seoDescription, $seoSuffix;

    /**
     * @param ISEO $model
     */
    public function setSeo(ISEO $model) {
        $this->seoTitle = $model->getSeoTitle();
        $this->seoDescription = $model->getSeoDescription();
    }

    public function beforeAction($action) {
        $this->seoSuffix = \Yii::$app->params['seoSuffix'];
        $controller = $this;
        $this->view->on(View::EVENT_BEFORE_RENDER, function($event) use ($controller){
            $controller->applaySeo();
        });

        return true;
    }

    private function applaySeo() {
        $title = [];

        // add title
        if (!empty($this->seoTitle)) {
            $title[] = $this->seoTitle;
        }

        // add siffix
        if(!empty($this->seoSuffix)) {
            $title[] = $this->seoSuffix;
        }

        // TODO[eugen] Use the page number prefix if count more then one into title and description

        // applay title
        if(!empty($title)) {
            $this->view->title = implode(' | ', $title);
        }
        // add description
        if (!empty($this->seoDescription)) {
            $this->view->registerMetaTag([
                'name' => 'description',
                'content' => $this->seoDescription
            ]);
        }
    }

}