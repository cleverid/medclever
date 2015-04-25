<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 03.01.15
 * Time: 14:48
 */

namespace frontend\controllers;


use common\models\Rubric;
use yii\base\Exception;
use yii\web\HttpException;

class RubricController extends Controller {

    /** View rubric */
    public function actionView($url) {
        $model = Rubric::find()->where(array('url' => $url))->one();
        if(!$model) {
            throw new HttpException(404, "Страница не найдена");
        }

        $this->setSeo($model);

        if(!$model->isLeaf()) {
            $rubribs = $model->children()->all();
            return $this->render("list", [
                'model' => $model,
                'rubribs' => $rubribs,
            ]);
        } else {
            return $this->render("view", [
                'model' => $model,
            ]);
        }
    }

}