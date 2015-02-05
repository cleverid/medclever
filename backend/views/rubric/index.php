<?php

use common\models\Rubric;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RubricSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rubrics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubric-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Rubric',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'value' => function($model, $key, $index, $grid) use ($dataProvider) {
                    /** @var GridView $grid */
                    $prefix = '';
                    if($dataProvider->getSort()->getAttributeOrder('lft') == SORT_ASC) {
                        $prefix = str_repeat('. ', $model->depth - 1);
                    }
                    /** @var Rubric $model */
                    return $prefix.$model->name;
                }
            ],
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function($model) {
                    /** @var Rubric $model */
                    return Html::a($model->url, $model->getUrl(true));
                },
            ],
            'description:html',
            'active',
             'created_at',
             'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
