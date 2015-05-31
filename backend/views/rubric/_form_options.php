<?
use common\models\Rubric;
use yii\helpers\ArrayHelper;
?>

<?= $form->field($model, 'sort')->textInput() ?>

<?= $form->field($model, 'active')->checkbox() ?>