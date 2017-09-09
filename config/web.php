<?php
use kartik\mpdf\Pdf;

require(__DIR__ . '/functions.php');

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', /*'app\extensions\DynamicRoutes'*/],
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
        'authServer' => [
            'class' => \jakim\authserver\Server::class,
            'grantTypes' => [
                'password' => \jakim\authserver\grants\PasswordCredentials::class,
                'refresh_token' => \jakim\authserver\grants\RefreshToken::class,
            ],
        ],
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
            'loginUrl' => '/admin/auth/login',
        ],
        'errorHandler' => [
            'errorAction' => '/admin/site/error',
        ],
        'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'useFileTransport' => false,
                'enableSwiftMailerLogging' => true,
                'messageConfig' => [
                    'from' => $params['email-username'],
                ],
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => $params['email-host'],
                    'username' => $params['email-username'],
                    'password' => $params['email-password'],
                    'port' => $params['email-port'],
                    'encryption' => $params['email-encryption'],
                    'streamOptions' => [
                        'ssl' => [
                            'allow_self_signed' => true,
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ],
                    ],
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

//        'sender' => [
//            'class' => '\app\components\Sender',
//        ],

        ],

        'db' => require(__DIR__ . '/db.php'),

        // 'formatter'  => [
        //     'class' => 'yii\i18n\Formatter',
        //     'timeZone'        => 'Europe/London',
        // ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [

                 'test'=>'/admin/pages/test',

                ['class' => 'yii\web\UrlRule', 'pattern' => '/admin', 'route' => '/admin/site/index'],

//                ['class' => 'yii\rest\UrlRule', 'controller' => 'actions',
//                    'extraPatterns' => ['POST create' => 'create']
//                ],
//                ['class' => 'yii\rest\UrlRule', 'controller' => 'clients',
//                    'extraPatterns' => ['POST create' => 'create', 'POST upload' => 'upload', 'POST unsub' => 'unsub']
//                ],
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
        'generators' => [
            'crud' => [
                'class' => \yii\gii\generators\crud\Generator::class,
                'template' => 'adminLte2',
                'templates' => [
                    'adminLte2' => '@vendor/jakim-pj/yii2-gii-adminLte2/generators/crud/',
                ],
            ],
        ],
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
