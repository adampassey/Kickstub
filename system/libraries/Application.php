<?php if( !defined( 'KICKSTUB_EXEC' ) ) die( 'Must load Kickstub to load this file.' );

class Application {

	private $contents;

	public function Application() {
		$this->Load = new Load();
		$this->Load->attach( $this );
	}
	
	public function lifetime() {
				
		//	load the system objects
		$this->Load->sys( 'Config', PATH_CONFIG, false );		
		$this->Load->sys( 'Router', PATH_LIBRARY );
		$this->Load->sys( 'Db', PATH_LIBRARY, false );
		$this->Load->sys( 'ResourceManager', PATH_LIBRARY, false );
		$this->Load->sys( 'Controller', PATH_LIBRARY, false );
		$this->Load->sys( 'Model', PATH_LIBRARY, false );
		
		//	loop through libraries / models and
		//	load the applications dependencies
		//	these will not be instantiated and passed
		//	to the application object
		foreach( Config::getInstance()->LIBRARIES as $key => $lib )
			$this->Load->library( $lib, false );
	}
	
	public function route() {
			
		$this->Router->route();
		
		ob_start();
		
			if( !file_exists( PATH_CONTROLLERS . DS . $this->Router->controller() . '.php' ) ) {
				$this->Load->controller( 'Error' );
				if( method_exists( $this->Error, 'index' ) )
					call_user_func( Array( $this->Error, 'index' ) );
			} else {
				$controllerClass = $this->Router->controller();
				$this->Load->controller( $controllerClass );
				call_user_func( Array( $this->$controllerClass, $this->Router->method() ) );
			}
		
				$this->contents = ob_get_contents();

		ob_end_clean();
	}
	
	public function render() {
		
		$ResourceManager = ResourceManager::getInstance();
		
		$arraySearch = Array(
			'{css}',
			'{js}'
		);
		

		$arrayReplace = Array(
			$ResourceManager->generateCss(),
			$ResourceManager->generateJs()
		);

	
		$this->contents = str_replace( $arraySearch, $arrayReplace, $this->contents );
	
			echo $this->contents;	
	}
	
	public function dealloc() {
		
		unset( $this->Load );
	}
}