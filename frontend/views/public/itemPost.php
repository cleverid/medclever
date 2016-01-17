
<?
/**
 * @var common\models\Post $model
 */
?>
<div class="post-item">
    <div class="post-item__title">
        <a href="<?=$model->getUrl()?>"><?=$model->name?></a>
    </div>
    <?=$this->render('postInfo', ['model' => $model])?>
    <div class="post-item__text">
        <?=$model->content_short?>
    </div>
    <a href="<?=$model->getUrl()?>" class="btn">Читать дальше →</a>
</div>