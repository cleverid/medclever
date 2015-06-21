
<?
/**
 * @var common\models\Post $model
 */
?>
<div class="post-item">
    <div class="post-item-title">
        <a href="<?=$model->getUrl()?>"><?=$model->name?></a>
    </div>
    <?if(0):?>
        <?=$this->render('postInfo', ['model' => $model])?>
    <?endif;?>
    <div class="post-item-text">
        <?=$model->content_short?>
    </div>
    <a href="<?=$model->getUrl()?>" class="btn">Читать дальше →</a>
</div>