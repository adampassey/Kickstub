<?php if( !defined( 'KICKSTUB_EXEC' ) ) die( 'Must load Kickstub to load this file.' );

class Model {
	
	public function Model( $Parent ) {
		
		$this->Load = new Load();
		$this->Load->attach( $Parent );
	}
}