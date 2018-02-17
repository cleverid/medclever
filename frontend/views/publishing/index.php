

<?use
    yii\widgets\ListView;

/**
 * @var \common\models\Rubric $model
 */
?>

<?if($model):?>
    <h1><?=$model->name?></h1>
<?endif;?>
<?= ListView::widget([
    'dataProvider' => $files,
    'itemView' => '/public/itemFile',
    'layout' => '{items}{pager}',
]) ?>