<?php
require(__DIR__ . '/functions.php');

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'v1' => [
            'class' => \app\modules\api\v1\Module::class,
        ],
    ],
    'defaultRoute' => '/admin/site',
    'homeUrl' => '/admin/site',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xxxxxxxxxx',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/admin/site/login',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                // 'viewPath' => '/layouts/email',
                'useFileTransport' => false,
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.mailtrap.io',
                    'username' => '638f257e3a8555',
                    'password' => '8d470dafa0a2a5',
                    'port' => '2525',
                    'encryption' => 'tls',
                                ],
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
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'countries'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'languages'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'stores'],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'actions',
                    'extraPatterns' => ['POST create' => 'create']
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'clients',
                    'extraPatterns' => ['POST create' => 'create', 'POST upload' => 'upload']
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'sessionsapps',
                    'extraPatterns' => ['POST create' => 'create']
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
