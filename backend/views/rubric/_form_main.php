
<?
use backend\components\InputFile;
use backend\widgets\Tinymce\Tinymce;
use backend\widgets\TreeInAfter\TreeInAfter;
use common\models\Rubric;
?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'parent_id')->widget(TreeInAfter::className(), ['root' => Rubric::getRoot()]);?>

<?= $form->field($model, 'image_file')->widget(InputFile::className(), [
    'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
    'multiple'      => false,       // возможность выбора нескольких файлов
]) ?>

<?= $form->field($model, 'description_short')->widget(Tinymce::className(), []) ?>

<?= $form->field($model, 'description')->widget(Tinymce::className(), []) ?>