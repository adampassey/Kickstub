<?php
/**
 *	Kickstump
 *	An itsy bitsy teenie weenie yellow polka dot PHP MVC framework
 *	that doesn't require mod_rewrite
 *	Yes, that mean's it works with GoDaddy
 */

//	start the session
session_start();

//	turn error reporting on
error_reporting( -1 );
ini_set( 'display_errors', 1 );

//	define constants
define( 'KICKSTUB_VERSION', '1.0' );
define( 'KICKSTUB_EXEC', 	true );
define( 'DS', '/' );
define( 'PATH', 			dirname( __FILE__ ) );
define( 'PATH_SYSTEM', 		PATH . DS . 'system' );
define( 'PATH_LIBRARY', 	PATH_SYSTEM . DS . 'libraries' );
define( 'PATH_APPLICATION', PATH_SYSTEM . DS . 'application' );
define( 'PATH_CONFIG',		PATH_SYSTEM . DS . 'config' );
define( 'PATH_CONTROLLERS', PATH_APPLICATION . DS . 'controllers' );
define( 'PATH_LIBRARIES', 	PATH_APPLICATION . DS . 'libraries' );
define( 'PATH_MODELS', 		PATH_APPLICATION . DS . 'models' );
define( 'PATH_VIEWS', 		PATH_APPLICATION . DS . 'views' );

//	define the 'URL' constant
preg_match( '/(.*)index\.php/', $_SERVER['PHP_SELF'], $basePathMatch );
if( isset( $basePathMatch[1] ) )
	define( 'URL',  'http://' . $_SERVER['HTTP_HOST'] . $basePathMatch[1] );
else
	define( 'URL', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] );
	
define( 'RESOURCE', 		URL . 'system' . DS . 'application' . DS . 'resources' );
define( 'CSS', 				RESOURCE . DS . 'css' );
define( 'IMG', 				RESOURCE . DS . 'img' );
define( 'JS', 				RESOURCE . DS . 'js' );

//	load the main Load file
if( !file_exists( PATH_LIBRARY . DS . 'Load.php' ) )
	die( 'Unable to load Load file at <strong>' . PATH_LIBRARY . DS . 'Load.php</strong>.' );

//	include the Load class	
include( PATH_LIBRARY . DS . 'Load.php' );

//	instantiate a load object
$Load = new Load();

//	load the main application file
if( $Load->sys( 'Application', PATH_LIBRARY ) )

//	unset our loader
unset( $Load );

//	instantiate the primary application object
$Application = new Application();

//	initiate the lifetime objects
$Application->lifetime();

//	route & process the request
$Application->route();

//	render the results
$Application->render();

//	dealloc
$Application->dealloc();

//	unset the application
unset( $Application );