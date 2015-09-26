
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
        <div class="file-item__download">
            <a href="<?=$model->getUrlForDownload()?>">Скачать</a>
            <span class="file-item__size">[<?=$model->getSizeHuman()?>]</span>
        </div>
    </div>
    <div style="clear: both"></div>
</div>