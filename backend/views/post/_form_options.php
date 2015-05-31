<?
use common\models\Rubric;
use yii\helpers\ArrayHelper;
?>

<?= $form->field($model, 'views')->textInput([ 'readonly' => true ]) ?>

<?= $form->field($model, 'sort')->textInput() ?>

<?= $form->field($model, 'active')->checkbox() ?>