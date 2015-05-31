
<?
use backend\widgets\Tinymce\Tinymce;
use backend\widgets\TreeInAfter\TreeInAfter;
use common\models\Rubric;
?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'parent_id')->widget(TreeInAfter::className(), ['root' => Rubric::getRoot()]);?>

<?= $form->field($model, 'description_short')->widget(Tinymce::className(), []) ?>

<?= $form->field($model, 'description')->widget(Tinymce::className(), []) ?>