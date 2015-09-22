<?
/** @var \common\models\File $model */
?>

<?if(!empty($model->name)):?>
    <span><?=$model->getUrlForDownload()?></span>
<?endif;?>
<?= $form->field($model, 'fileObject')->fileInput() ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

