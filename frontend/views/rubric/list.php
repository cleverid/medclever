<?
use yii\widgets\ListView;
/**
 * @var common\models\Rubric[] $rubrics
 * @var common\models\Rubric $model
 */
?>
<h1><?= $model->name?></h1>

<?= ListView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $rubrics]),
    'itemOptions' => ['class' => 'rubric-item'],
    'itemView' => '/public/itemRubric',
    'layout' => '{items}{pager}',
]) ?>