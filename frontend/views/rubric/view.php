<?
use yii\widgets\ListView;

/**
 * @var common\models\Rubric $model
 * @var common\models\Post[] $posts
 */

?>
<h1><?= $model->name?></h1>
<div>
    <?=$model->description?>
</div>

<?= ListView::widget([
    'dataProvider' => $posts,
    'itemOptions' => ['class' => 'post-item'],
    'itemView' => '/public/itemPost',
    'layout' => '{items}',
]) ?>