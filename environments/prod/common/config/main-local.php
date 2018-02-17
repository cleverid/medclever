<?php

$MYSQL_HOST = getenv("MYSQL_HOST");
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => "mysql:host=$MYSQL_HOST;dbname=medclever",
            'username' => getenv("MYSQL_USER"),
            'password' => getenv("MYSQL_PASSWORD"),
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
