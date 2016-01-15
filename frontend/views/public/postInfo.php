<?
/**
 * @var common\models\Post $model
 */
?>
<div class="post-item-info">
    <span class="post-item-create">
        Создано: <?=Yii::$app->formatter->asDate($model->published_at);?>
    </span>
    <span class="post-item-author">
        Автор: Чайцев В. Г.
    </span>
    <span class="post-item-viewed">
        Просмотров: <?=$model->views?$model->views:0?>
    </span>
</div>