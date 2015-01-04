<?
/** @var yii\base\View $this */
?>
<?if(!empty($items)):?>
    <ul class="menu-side">
        <? foreach($items as $item):?>
            <li class="<?=$item['active']?'active':''?>">
                <a href="<?=$item['url']?>"><?=$item['name']?></a>
            </li>
        <? endforeach;?>
    </ul>
<?endif;?>