<?
/** @var yii\base\View $this */
?>
<?if(!empty($items)):?>
    <ul class="menu-side">
        <?php foreach($items as $item):?>
            <li class="<?=$item['active']?'active':''?> depth<?=$item['depth']?>">
                <a href="<?=$item['url']?>"><?=$item['name']?></a>
            </li>
        <?php endforeach;?>
    </ul>
<?endif;?>