<?
/**
 * @var common\models\Post $model
 */
?>
<div class="post-item-info">
    <span class="post-item-create">
        Создано: <?=Yii::$app->formatter->asDatetime($model->published_at, Yii::$app->params['dateFormat']);?>
    </span>
    <span class="post-item-author">
        Автор: Кирюхин А.
    </span>
    <span class="post-item-viewed">
        Просмотров: <?=$model->views?>
    </span>
</div>
<div class="post-item-filter">
    <span class="post-item-rubric">
        <i class="micon-rubric"></i>Рубрика
    </span>
    <span class="post-item-tags">
        <i class="micon-tag"></i>
        <span class="post-item-tag"><a href="#">Тег1</a></span>
        <span class="post-item-tag"><a href="#">Тег2</a></span>
        <span class="post-item-tag"><a href="#">Тег3</a></span>
    </span>
</div>