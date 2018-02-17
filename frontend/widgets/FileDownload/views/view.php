<?
/** @var $file \common\models\File */
?>

<div class="file-item__download">
    <a class="file-item__link" data-id=<?=$file->id?> href="<?=$file->getUrlForDownload()?>">Скачать</a>
    <span class="file-item__size">[<?=$file->getSizeHuman()?>]</span>
</div>