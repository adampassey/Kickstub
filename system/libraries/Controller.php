<?php if( !defined( 'KICKSTUB_EXEC' ) ) die( 'Must load Kickstub to load this file.' );

class Controller {
	
	public function Controller( $Parent ) {
		
		$this->Load = new Load();
		$this->Load->attach( $Parent );
	}
}