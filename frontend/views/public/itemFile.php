
<?
/**
 * @var common\models\File $model
 */
?>
<div class="file-item">
    <div class="file-item__left">
        <div class="file-item__icon"></div>
    </div>
    <div class="file-item__right">
        <div class="file-item__title" >
            <a href="<?=$model->getUrl()?>"><?=$model->title?></a>
        </div>
        <?if(!empty($model->description_short)):?>
            <div class="file-item__description">
                <?=$model->description_short?>
            </div>
        <?endif;?>
        <?=\frontend\widgets\FileDownload\FileDownload::widget(['file' => $model])?>
    </div>
    <div style="clear: both"></div>
</div>