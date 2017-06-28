<?php
use kartik\mpdf\Pdf;

require(__DIR__ . '/functions.php');

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'app\extensions\DynamicRoutes'],
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
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_FILE,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // 'cssFile' => '@web/bootstrap/css/bootstrap.css',
            // refer settings section for all configuration options
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
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => $params['email-host'],
                    'username' => $params['email-username'],
                    'password' => $params['email-password'],
                    'port' => $params['email-port'],
                    'encryption' => $params['email-encryption'],
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

        // 'sender' => [
        //     'class' => \app\components\Sender::class,
        //     ],

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
                ['class' => 'yii\web\UrlRule', 'pattern' => '/admin', 'route' => '/admin/site/index'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'countries'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'languages'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'stores'],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'actions',
                    'extraPatterns' => ['POST create' => 'create']
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'clients',
                    'extraPatterns' => ['POST create' => 'create', 'POST upload' => 'upload', 'POST unsub' => 'unsub']
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
