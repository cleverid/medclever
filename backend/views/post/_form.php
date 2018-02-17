<?php

use backend\components\Tabs;
use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?$paramsView = [
        'form' => $form,
        'model' => $model,
    ] ?>

    <div class="container-fluid" style="padding-left: 0;">
        <div class="row col-md-9">
            <?= Tabs::widget([
                'itemOptions' => [
                    'class' => 'test'
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Main'),
                        'content' => $this->render('_form_main', $paramsView),
                        'active' => true
                    ],
                    [
                        'label' => Yii::t('app', 'SEO'),
                        'content' => $this->render('_form_seo', $paramsView),
                    ]
                ]]) ?>
        </div>
        <div class="col-md-3">
            <?= Collapse::widget([
                'items' => [
                    // equivalent to the above
                    [
                        'label' => Yii::t('app', 'Options'),
                        'content' => $this->render('_form_options', $paramsView),
                        // open its content by default
                        'contentOptions' => ['class' => 'in']
                    ],
                ]
            ]);?>
        </div>
    </div>

    <hr />

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
