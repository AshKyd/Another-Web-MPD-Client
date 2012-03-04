<?php

class GetArtists extends MpdFrontend{
	
	public $artists = Array();
	
	function __construct(){
		parent::__construct();
		$this->title = 'Artist List';
		$this->artists = $this->mpd->getArtists();
		sort($this->artists);
	}
	
}
