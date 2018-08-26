<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'rubric/<url>' => 'rubric/view',
                'post/<url>' => 'post/view',
                'post/countup/<id:\d+>' => 'post/countup',
                'library' => 'site/library',
                'publishes' => 'publishing/index',
                'publish/<id:\d+>' => 'publishing/view',
                'publish-download-inc/<id:\d+>' => 'publishing/downloadinc',
                'publish-view-inc/<id:\d+>' => 'publishing/viewinc',
                'sitemap.xml'=>'sitemap/index',
                '<controller>/<action>' => '<controller>/<action>',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
