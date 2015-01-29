<?php

use backend\widgets\Tinymce\Tinymce;
use common\models\Rubric;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Rubric */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rubric-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(
        ArrayHelper::map(Rubric::getRoot()->children()->all(), 'id', function($i){
            return str_repeat('- ',$i->depth) . $i->name;
        }),
        [
            'prompt' => 'Не указано'
        ]
    ) ?>

    <?= $form->field($model, 'description_short')->widget(Tinymce::className(), []) ?>

    <?= $form->field($model, 'description')->widget(Tinymce::className(), []) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
