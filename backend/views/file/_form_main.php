<?
/** @var \common\models\File $model */
use backend\widgets\Tinymce\Tinymce;

?>

<?if(!empty($model->name)):?>
    <span><?=$model->getUrlForDownload()?></span>
<?endif;?>

<?= $form->field($model, 'fileObject')->fileInput() ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'description_short')->textarea(['maxlength' => true]) ?>

<?= $form->field($model, 'description')->widget(Tinymce::className(), []) ?>

