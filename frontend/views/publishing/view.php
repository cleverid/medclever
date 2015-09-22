<? /** @var \common\models\File $file */?>
<h1><?=$file->title?></h1>
<div>
    <?= $file->description ?>
</div>
<div>
    <a href="<?=$file->getUrl()?>"><?=$file->name?></a>
</div>