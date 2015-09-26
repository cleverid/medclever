<?
/** @var \common\models\File $model */
use common\models\Rubric;
use yii\helpers\ArrayHelper;
?>

<?= $form->field($model, 'size')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'views')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'downloads')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'created_at')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'updated_at')->textInput(['disabled' => true]) ?>
