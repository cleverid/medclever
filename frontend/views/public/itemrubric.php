
<?
/**
 * @var common\models\Rubric $model
 */
?>
<div class="rubric-item">
    <div class="rubric-item-title">
        <a href="<?=$model->getUrl()?>"><?=$model->name?></a>
    </div>
    <div class="rubric-item-text">
        <?=$model->description_short?>
    </div>
</div>