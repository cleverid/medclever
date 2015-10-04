<? /** @var \common\models\File $file */?>
<div class="file-page">
    <h1><?=$file->title?></h1>
    <?=\frontend\widgets\FileDownload\FileDownload::widget(['file' => $file])?>
    <div class="file-page__description">
        <?= $file->getDescription() ?>
    </div>
</div>