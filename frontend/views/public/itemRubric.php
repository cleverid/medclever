
<?
/**
 * @var common\models\Rubric $model
 */
?>
<div class="rubric-item">
    <div class="rubric-item-image">
        <a href="<?=$model->getUrl()?>">
            <img src="<?=$model->image_file?>" />
        </a>
    </div>
    <div class="rubric-item-title">
        <a href="<?=$model->getUrl()?>"><?=$model->name?></a>
    </div>
    <div class="rubric-item-text">
        <?=$model->description_short?>
    </div>
    <div style="clear: both"></div>
</div>