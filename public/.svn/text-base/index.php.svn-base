<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
$includePaths = array();
if (APPLICATION_ENV == 'development')
{
	$includePaths[] = realpath('C:\wamp\bin\zend-framework');
	set_time_limit(0);
}
$includePaths[] = realpath(APPLICATION_PATH . '/../library');
$includePaths[] = get_include_path() ;
set_include_path(implode(PATH_SEPARATOR, $includePaths));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

// Get Config
$bootstrap = $application->getBootstrap();
$options = $bootstrap->getOptions();
// Save DB Data
$db_data = $options['db'];
$db = Zend_Db::factory($db_data['adapter'], $db_data['params']);
Zend_Registry::set('db', $db);

$application->bootstrap()
            ->run();