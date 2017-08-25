<?php
require(__DIR__ . '/functions.php');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'sender' => [
            'class' => '\app\components\Sender',
        ],
        'reportsgen' => [
            'class' => '\app\components\Reportsgen',
        ],
        'generator' => [
            'class' => '\app\components\Generator',
        ],
        'db' => $db,
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'enableSwiftMailerLogging' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => $params['email-host'],
                'username' => $params['email-username'],
                'password' => $params['email-password'],
                'port' => $params['email-port'],
                'encryption' => $params['email-encryption'],
            ],
        ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
