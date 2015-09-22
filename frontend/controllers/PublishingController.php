<?php

namespace frontend\controllers;

use common\models\File;
use common\models\Rubric;
use yii\data\ActiveDataProvider;

class PublishingController extends Controller
{

    // список пкбликаций
    public function actionIndex() {

        $files = new ActiveDataProvider([
            'query' => File::find()
                        ->active(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $model = Rubric::findOne(['url' => "/publikacii"]);

        return $this->render('index', array(
            'files' => $files,
            'model' => $model,
        ));
    }

    // отображение одной публикации
    public function actionView($id)
    {
        $file = File::find()->active()->where(['id' => $id])->one();
        if(!$file) {
            $this->pageNotFound();
        }

        $this->setSeo($file);

        return $this->render('view', [
            'file' => $file
        ]);
    }

}
