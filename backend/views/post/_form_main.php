
<?
use backend\widgets\Tinymce\Tinymce;
use common\models\Rubric;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'rubric_id', [])->dropDownList(
    ArrayHelper::map(Rubric::getRoot()->children()->all(), 'id', function ($i) {
        return str_repeat('. ', $i->depth - 1) . $i->name;
    }),
    ['prompt' => '']) ?>

<?= $form->field($model, 'published_at')->widget(
    DateTimePicker::className(), [
    // inline too, not bad
    'inline' => false,
    'language' => 'ru',
    'size' => 'ms',
    'clientOptions' => [
        'autoclose' => true,
        'todayBtn' => true
    ]
]);?>

<?= $form->field($model, 'content_short')->widget(Tinymce::className(), []) ?>

<?= $form->field($model, 'content')->widget(Tinymce::className(), [
    'configs' => [ 'height' => 500, ]
]) ?>