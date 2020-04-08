<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
     'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Moudle',
        ],
         'security' => [
            'class' => 'app\modules\security\Moudle',
        ],
         'department' => [
            'class' => 'app\modules\department\Moudle',
        ],
        'public' => [
            'class' => 'app\modules\public\Moudle',
        ],
    ],
    'defaultRoute'=>'site',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HRVISITOR',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'Utility' => [
			'class' => 'app\components\Utility',
		],
		 'view' => [
            'theme' => [
                'pathMap' => [
                   '@app/views' => '@vendor/yidas/yii2-adminlte/templates/example'
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'authTimeout' =>  3600,
            'enableSession'=>true,
            'autoRenewCookie'=>true,
        ],
        'session' => [
		'class' => 'yii\web\Session',
		'cookieParams' => ['httponly' => true, 'lifetime' =>  3600*4],
		'timeout' =>  3600*4, //session expire
		'useCookies' => true,
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
        'db' => $db,
          'assetManager' => [
        'bundles' => [
            'yidas\adminlte\AdminlteAsset' => [
                'skin' => 'skin-black',
            ],
        ],
    ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,    
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
  //  $config['bootstrap'][] = 'debug';
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
