<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'=>'ru-RU',
    'bootstrap' => ['log', 'thumbnail'],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'thumbnail' => [
            'class' => 'himiklab\thumbnail\EasyThumbnail',
            'cacheAlias' => 'thumbs',
        ],
        'formatter' => [
            'timeZone' => 'Europe/Moscow',
            'dateFormat' => 'dd MMMM yyyy',
            'timeFormat' => 'H:mm:ss',
            'datetimeFormat' => 'dd MMMM yyyy H:mm',
        ],
    ],
];
