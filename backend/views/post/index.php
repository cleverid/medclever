<?php

use common\models\Post;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post', []), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'format' => 'raw',
                'attribute' => 'url',
                'value' => function($data) {
                    /** @var Post $data */
                    return Html::a($data->url, $data->getUrl(true), [
                        'title' => $data->url,
                    ]);
                }
            ],
            [
                'format' => 'html',
                'attribute' => 'content_short',
                'value' => function($data) {
                    /** @var Post $data */
                    $strip = strip_tags($data->content_short);
                    return StringHelper::truncateWords($strip, Yii::$app->params['gridContentWordsCount']);
                }
            ],
            [
                'attribute' => 'published_at',
                'value' => 'published_at',
            ],
            [
                'label' => Yii::t('app', 'Rubric'),
                'value' => 'rubric.name'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
