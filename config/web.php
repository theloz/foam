<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'language'=>'it',
    'sourceLanguage' => 'it-IT',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '337ad2fb8ae09d5ce11dd882571c55f5f5457bba',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
	'Ltcpdf'	=> [
		'class'	=> 'app\components\Ltcpdf',
	],
        'db' => require(__DIR__ . '/db.php'),
	'urlManager' => [
		'class' => 'yii\web\UrlManager',
		// Disable index.php
		'showScriptName' => false,
		// Disable r= routes
		'enablePrettyUrl' => true,
		'rules' => [
			'<controller:\w+>/<id:\d+>' => '<controller>/view',
			'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
			'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
		],
        ],
	/*'i18n' => [
		'translations' => [
		    'yii' => [
			'class' => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'it-IT',
			//'language' => 'it-IT',
			'basePath' => '@app/messages'
		    ],
		],
	],*/
	
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
