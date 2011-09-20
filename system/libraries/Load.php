<?php if( !defined( 'KICKSTUB_EXEC' ) ) die( 'Must load Kickstub to load this file.' );

class Load {
	
	private static $loaded = Array();
	
	private $Parent;
	
	public function Load() {}
	
	private function import( $file ) {
		
		if( array_key_exists( $file, Load::$loaded ) )
			return true;
		
		if( substr( $file, strlen( $file ) - 4 , 4 ) != '.php' )
			$file .= '.php';
		
		if( file_exists( $file ) ) {
			include( $file );
			$loaded[] = $file;
			return true;
		}
		return false;
	}
	
	public function library( $file, $instantiate = true ) {
		if( $this->import( PATH_LIBRARIES . DS . $file ) && $this->Parent && $instantiate )
			$this->Parent->$file = new $file;
	}
	
	public function model( $file, $instantiate = true ) {
		if( $this->import( PATH_MODELS . DS . $file ) && $this->Parent && $instantiate )
			$this->Parent->$file = new $file;
	}
	
	public function controller( $file, $instantiate = true ) {
		if( $this->import( PATH_CONTROLLERS . DS . $file ) && $this->Parent && $instantiate )
		  	$this->Parent->$file = new $file;
		// echo 'in load controller';
	}
	
	public function sys( $file, $path, $instantiate = true ) {
		if( $this->import( $path . DS . $file ) && $this->Parent && $instantiate )
			$this->Parent->$file = new $file;
	}
	
	public function view( $file, $data = NULL, $return = false ) {
	
		if( $data ) 
			foreach( $data as $key => $value )
				$$key = $value;
				
		$file = PATH_VIEWS . DS . $file . '.phtml';
		
		if( $return )
			ob_start();
		
		if( file_exists( $file ) )
			include( $file );
			
		if( $return ) {
			$contents = ob_get_contents();
			ob_end_clean();
			return $contents;
		}
			
	}
	
	public function attach( $Object ) {
		$this->Parent = $Object;
	}
}