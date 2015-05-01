<?
/** @var yii\base\View $this */
?>
<?if(!empty($items)):?>
    <ul class="menu-side">
        <? foreach($items as $item):?>
            <li class="<?=$item['active']?'active':''?> depth<?=$item['depth']?>">
                <a href="<?=$item['url']?>"><?=$item['name']?></a>
            </li>
        <? endforeach;?>
    </ul>
<?endif;?>