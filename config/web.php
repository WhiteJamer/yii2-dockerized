<?php
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'vendorPath' => realpath(__DIR__.'/../../vendor'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\ApcCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv_default('DB_DSN', 'mysql:host=localhost;dbname=web'),
            'username' => getenv_default('DB_USER', 'web'),
            'password' => getenv_default('DB_PASSWORD', 'secret'),
            'charset' => 'utf8',
            'tablePrefix' => '',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'log' => [
            'traceLevel' => getenv_default('YII_TRACELEVEL', 0),
            'targets' => [
                [
                    'class' => 'app\components\StdTarget',
                    'stream' => 'stdout',
                    'levels' => ['info','trace'],
                    'logVars' => [],
                ],
                [
                    'class' => 'app\components\StdTarget',
                    'stream' => 'stderr',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY'),
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
    ],
    'params' => require(__DIR__.'/params.php'),
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
