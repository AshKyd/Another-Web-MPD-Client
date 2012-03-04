<?php

class GetStatus extends MpdFrontend{
	
	public $album = Array();
	
	function __construct(){
		parent::__construct();
		$this->title = 'Player Status';
	}
	
}
