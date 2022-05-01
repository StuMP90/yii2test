<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'jodit' => [
            'class' => 'yii2jodit\JoditModule',
            'extensions'=>['jpg','png','gif'],
            'root'=> $_SERVER['DOCUMENT_ROOT'] . '/web/uploads/',
            'baseurl'=> '@web/uploads/',
            'maxFileSize'=> '20mb',
            'defaultPermission'=> 0775,
        ],
    ],
];
