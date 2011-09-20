<?php if( !defined( 'KICKSTUB_EXEC' ) ) die( 'Must load Kickstub to load this file.' );

class Delegate extends Controller {
	
	public function Delegate() {
		parent::__construct( $this );
	}
	
	public function index() {
		
		//	load a model like this
		$this->Load->model( 'ExampleModel' );
		
		//	interact with a model like this
		$data['modelResponse'] = $this->ExampleModel->willDoSomeEvent();
		
		//	load a view and pass data like this
		$this->Load->view( 'Delegate', $data );
	}
	
	
}