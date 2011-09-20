<?php if( !defined( 'KICKSTUB_EXEC' ) ) die( 'Must load Kickstub to load this file.' );

class ResourceManager {
	
	private static $css = Array();
	
	private static $js = Array();
	
	private function ResourceManager() {}
	
	public static function attachCss( $css ) {

		if( !in_array( $css, self::$css ) )
			self::$css[] = $css;
	}
	
	public static function attachJs( $js ) {

		if( !in_array( $js, self::$js ) )
			self::$js[] = $js;
	}
	
	public function generateCss() {
		
		self::$css = array_reverse( self::$css );
	
		$html = NULL;
		foreach( self::$css as $key => $css ) 
			$html .= '<link rel="stylesheet" type="text/css" href="' . CSS . DS . $css . '" />';
		return $html;
	}
	
	public function generateJs() {
		
		self::$js = array_reverse( self::$js );
	
		$html = NULL;
		foreach( self::$js as $key => $js )
			$html .= '<script type="text/javascript" src="' . JS . DS . $js .'"></script>';
		return $html;
	}
	
	public static function getInstance() {
		static $instance;
		if( !$instance )
			$instance = new self;
		return $instance;
	}
}