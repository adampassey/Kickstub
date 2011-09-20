<?php if( !defined( 'KICKSTUB_EXEC' ) ) die( 'Must load Kickstub to load this file.' );

class Router {

	private $controller;
	private $method;
	
	public function Router() {}
	
	public function route() {
		
		static $notPermitted = Array(
			'$',
			'(',
			')',
			'%28',
			'%29',
			' ',
			'%20',
		);
		
		static $notPermittedReplace = Array(
			'&#36;',
			'&#40;',
			'&#41;',
			'&#40',
			'&#41',
			'',
			''
		);
		
		$c = ( isset( $_GET['c'] ) ? $_GET['c'] : Config::getInstance()->preference( 'DEFAULT_CONTROLLER' ) );
		$m = ( isset( $_GET['m'] ) ? $_GET['m'] : Config::getInstance()->preference( 'DEFAULT_METHOD' ) );
		
		$c = str_replace( $notPermitted, $notPermittedReplace, $c );
		$m = str_replace( $notPermitted, $notPermittedReplace, $m );
		
		$this->controller = ucwords( strtolower( $c ) );
		$this->method = ucwords( strtolower( $m ) );
		
		unset( $c );
		unset( $m );
	}
	
	public function controller() {
		return $this->controller;
	}
	
	public function method() {
		return $this->method;
	}
}