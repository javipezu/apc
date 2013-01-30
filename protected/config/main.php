<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Internetria APC',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'defaultController' => 'site',
    'components' => array(
        'cache' => array(
            'class' => 'system.caching.CApcCache',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path',
        	'rules'=>array(
        		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        	),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
    ),
);