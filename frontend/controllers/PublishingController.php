<?php

namespace frontend\controllers;

use common\models\File;
use common\models\Rubric;
use yii\data\ActiveDataProvider;
use yii\web\View;

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

        $model = Rubric::findOne(['url' => "/publishes"]);

        $this->setSeo($model);

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

        $this->registrScriptViewCounter($file);
        return $this->render('view', [
            'file' => $file
        ]);
    }

    /**
     * @param $file File
     */
    private function registrScriptViewCounter($file) {
        $id = $file->id;
        $script = <<<JS
            setTimeout(function(){
                $.ajax({
                    url: "/publish-view-inc/$id",
                    type: "GET"
                });
            }, 2000);

JS;

        $this->view->registerJs($script, View::POS_READY, __CLASS__);
    }

    public function actionViewinc($id) {
        /** @var File $file */
        $session = \Yii::$app->session;
        $key = 'view_file_'.$id;
        if(!$session->get($key)) {
            $file = File::findOne($id);
            $file->views += 1;
            $file->save();
            $session->set($key, 1);
        }
    }

    public function actionDownloadinc($id) {
        /** @var File $file */
        $file = File::findOne($id);
        $file->downloads += 1;
        $file->save();
    }

}
