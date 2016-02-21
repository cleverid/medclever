<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <?= ListView::widget([
            'dataProvider' => $posts,
            'itemView' => '/public/itemPost',
            'layout' => '{items}{pager}',
            'emptyText' => '',
        ]) ?>

        <div class="about-info">
            <h1 class="about-info__header">Разумная медицина</h1>
            <span class="about-info__text">
                - современные подходы к формированию
                и оценке образа жизни, рациональное поведение при первой помощи в
                неотложных ситуациях, развенчание бытовых мифов и предрассудков.
            </span>
        </div>

    </div>
</div>
