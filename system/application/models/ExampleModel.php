<?php

class ExampleModel extends Model {

	public function ExampleModel() {
		parent::__construct( $this );
	}
	
	public function willDoSomeEvent() {
		return 'ExampleModel did something sweet.';
	}
	
}