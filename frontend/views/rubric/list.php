<?
/**
 * @var common\models\Rubric[] $rubribs
 */
?>
<h1><?= $model->name?></h1>
<?foreach($rubribs as $rubriс):?>
    <div class="rubric-item">
        <div class="rubric-item-title">
            <a href="<?=$rubriс->getUrl()?>"><?=$rubriс->name?></a>
        </div>
        <div class="rubric-item-info">
            <span class="rubric-item-create">
                Создано: <?=Yii::$app->formatter->asDatetime($rubriс->created_at, Yii::$app->params['dateFormat']);?>
            </span>
            <span class="rubric-item-author">
                Автор: Кирюхин А.
            </span>
            <span class="rubric-item-viewed">
                Просмотров: 32
            </span>
        </div>
        <div class="rubric-item-filter">
            <span class="rubric-item-rubric">
                <i class="micon-rubric"></i>Рубрика
            </span>
            <span class="rubric-item-tags">
                <i class="micon-tag"></i>
                <span class="rubric-item-tag"><a href="#">Тег1</a></span>
                <span class="rubric-item-tag"><a href="#">Тег2</a></span>
                <span class="rubric-item-tag"><a href="#">Тег3</a></span>
            </span>
        </div>
        <div class="rubric-item-text">
            <?=$rubriс->description_short?>
        </div>
        <a href="<?=$rubriс->getUrl()?>" class="btn">Читать дальше →</a>
    </div>
<?endforeach;?>