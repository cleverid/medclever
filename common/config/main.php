<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'=>'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'timeZone' => 'Europe/Moscow',
            'dateFormat' => 'dd MMMM yyyy',
            'timeFormat' => 'H:mm:ss',
            'datetimeFormat' => 'dd MMMM yyyy H:mm',
        ],
    ],
];
