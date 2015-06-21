<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Post
 */
?>
<div class="post-page">
    <h1><?=$model->name?></h1>
    <?if(0):?>
        <?=$this->render('/public/postInfo', ['model' => $model])?>
    <?endif;?>

    <div class="content-data"><?=$model->content?></div>
</div>
