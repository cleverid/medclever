
<?
/**
 * @var common\models\File $model
 */
?>
<div class="rubric-item">
    <a href="<?=$model->getUrl()?>"><?=$model->title?></a>
    <?if(!empty($model->description)):?>
        <div><?=$model->description?></div>
    <?endif;?>
    <div style="clear: both"></div>
</div>