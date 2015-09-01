<?
use common\models\Rubric;
use yii\helpers\ArrayHelper;
?>

<?= $form->field($model, 'active')->checkbox() ?>

<?= $form->field($model, 'sort')->textInput() ?>

<?= $form->field($model, 'published_at')->textInput() ?>
