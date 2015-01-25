<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 28.12.14
 * Time: 0:13
 */

namespace frontend\widgets\MenuSide;


use common\models\Rubric;

class MenuSide extends \yii\base\Widget {

    public function init() {
    }

    public function run() {

        $items = [];
        /** @var Rubric[] $rubrics */
        $rubrics = Rubric::findOne(9)->children()->all();

        foreach($rubrics as $rubric) {
            $items[] = [
                "name" => $rubric->name,
                "url" => $rubric->getUrl(),
                "active" => $rubric->isActiveByUrl(\Yii::$app->request->url),
                "depth" => $rubric->depth - 1,
            ];
        }

        return $this->render('view', ['items' => $items]);
    }

}