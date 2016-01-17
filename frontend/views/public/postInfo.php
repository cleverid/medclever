<?
/**
 * @var common\models\Post $model
 */
?>
<div class="post-info">
    <span class="post-info__create" alt="Дата создания" title="Дата создания">
        <i class="icon-data"></i>
        <span class="post-info__text">
            <?=Yii::$app->formatter->asDate($model->published_at);?>
        </span>
    </span>
    <span class="post-info__author" alt="Автор" title="Автор">
        <i class="icon-author"></i>
        <span class="post-info__text">
            Чайцев В. Г.
        </span>
    </span>
    <span class="post-info__viewed" alt="Ко-во просмотров" title="Ко-во просмотров">
        <i class="icon-views"></i>
        <span class="post-info__text">
            <?=$model->views?$model->views:0?>
        </span>
    </span>
</div>