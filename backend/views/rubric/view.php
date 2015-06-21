<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Rubric */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rubrics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubric-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'format' => 'raw',
                'attribute' => 'image_file',
                'value' => !empty($model->image_file)
                    ?Html::img($model->image_file, ['style' => 'max-width:300px; max-height: 300px;'])
                    :'',
            ],
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => Html::a($model->url, $model->getUrl(true)),
            ],
            'description_short:html',
            'description:html',
            'meta_title',
            'meta_description',
            'active',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
