<?php if( !defined( 'KICKSTUB_EXEC' ) ) die( 'Must load Kickstub to load this file.' );

class Config {

	const VERSION 				= '1.1';
	
	const DEFAULT_CONTROLLER	= 'delegate';
	const DEFAULT_METHOD		= 'index';
	
	const DB_HOST				= 'host';
	const DB_DB					= 'database';
	const DB_USER				= 'username';
	const DB_PASS				= 'password';
	
	const SITE_TITLE			= 'Kickstub Web-Application Framework';
	
	const SESSION_PREFIX		= 'KS_';
	
	const TABLE_PREFIX			= 'KS_';
	
	public $LIBRARIES = Array(
	);
	
	private function Config() { }
	
	public function preference( $constant ) {
		
		static $Reflection;
		
		if( !$Reflection ) 
			$Reflection = new ReflectionClass( get_class( $this ) );
		
		return $Reflection->getConstant( $constant );
	}
	
	public static function getInstance() {
		static $instance;
		if( !$instance )
			$instance = new self;
		return $instance;
	}
}