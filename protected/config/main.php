<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'HexaTrip',

	// preloading 'log' component
	'preload'=>array('log'),
    //applying theme 
    'theme'=>'blackboot',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
             'application.modules.user.models.*',
                'application.modules.user.components.*',
            'ext.yii-mail.YiiMailMessage',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		/* 'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		), */
              'user' => array(
            'tableUsers' => 'tbl_users',
            'tableProfiles' => 'tbl_profiles',
            'tableProfileFields' => 'tbl_profiles_fields',
                  'returnUrl'=>array("/alert/index")
                  
        )
            ),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                     'loginUrl' => array('/user/login'),
                     'autoUpdateFlash' => false, // add this line to disable the flash counter
		),
            //theming the common widgets 
            'widgetFactory' => array(
            'widgets' => array(
                'CActiveForm' => array(
                    
                ),
                'CDetailView' => array(
                    'htmlOptions'=>array('class'=>'table table-striped table-bordered table-hover table-condensed'),
                ),
                'CGridView' => array(
                    
                ),
            ),
                ),
            //for working with YIIMAIL extension
            'mail' => array(
 			'class' => 'ext.yii-mail.YiiMail',
 			'transportType' => 'php',
 			'viewPath' => 'application.views.mail',
 			'logging' => true,
 			'dryRun' => false
 		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
                 * */
                 
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mobilel5_alert_star',
			'emulatePrepare' => true,
			'username' => 'mobilel5_ht01',
			'password' => 'gHkq]^$4S]4F',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@hexatrip.com',
	),
    
    
#...
      
);