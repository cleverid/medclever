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

    </div>
</div>
