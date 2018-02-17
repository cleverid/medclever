<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Post
 */
?>
<div class="post-page">
    <h1><?=$model->name?></h1>
    <?=$this->render('/public/postInfo', ['model' => $model])?>
    <div class="post-page__data">
        <?=$model->content?>
    </div>
</div>
