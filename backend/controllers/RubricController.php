<?php

namespace backend\controllers;

use backend\widgets\TreeInAfter\TreeInAfter;
use Yii;
use common\models\Rubric;
use common\models\RubricSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use creocoder\nestedsets\NestedSetsBehavior;

/**
 * RubricController implements the CRUD actions for Rubric model.
 */
class RubricController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Rubric models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RubricSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rubric model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rubric model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rubric();

        if ($model->load(Yii::$app->request->post())) {

            $model->applayRoot();

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rubric model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->applayRoot();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rubric model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Обновление виджета для дерева
     * @param $id
     * @return bool
     * @throws NotFoundHttpException
     */
    public function actionTree($id = null, $idWidget) {
        if($id == null) {
            $model = Rubric::getRoot();
            $id = $model->id;
        } else {
            $model = $this->findModel($id);
        }
        if(!$model) return false;

        $model->parent_id = $id;

        $widget = new TreeInAfter([
            'id' => $idWidget,
            'root' => Rubric::getRoot(),
            'model' => $model,
            'name' => 'name',
            'attribute' => 'parent_id',
        ]);

        echo $widget->run();
    }

    /**
     * Finds the Rubric model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rubric the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rubric::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
