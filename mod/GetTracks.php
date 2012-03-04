<?php

class GetTracks extends MpdFrontend{
	
	public $tracks = Array();
	public $artists = Array();
	
	function __construct(){
		parent::__construct();
		$this->artists = $this->mpd->getArtists();
		foreach($this->artists as $artist){
			if(!$artist){
				continue;
			}
			$tracks = $this->mpd->find(MPD_SEARCH_ARTIST,$artist);
			$tracks = array_merge($this->tracks,$tracks);
			$this->tracks = $tracks;
			//~ print_r($tracks);
		}
	}
}
