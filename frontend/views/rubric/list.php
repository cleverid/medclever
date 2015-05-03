<?
/**
 * @var common\models\Rubric[] $rubribs
 */

?>
<?foreach($rubribs as $rubrib):?>
    <div class="rubric-item">
        <a href="<?=$rubrib->getUrl()?>"><?=$rubrib->name?></a>
        <div class="item">
            <?=$rubrib->description_short?>
        </div>
        <a href="<?=$rubrib->getUrl()?>" class="btn">Читать дальше →</a>
    </div>
<?endforeach;?>