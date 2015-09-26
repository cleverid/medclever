<? /** @var \common\models\File $file */?>
<div class="file-page">
    <h1><?=$file->title?></h1>
    <div class="file-page__download">
        <a href="<?=$file->getUrlForDownload()?>">Скачать</a>
        <span class="file-page__size">[<?=$file->getSizeHuman()?>]</span>
    </div>
    <div class="file-page__description">
        <?= $file->getDescription() ?>
    </div>
</div>