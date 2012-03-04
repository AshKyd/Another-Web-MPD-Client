<?php

class GetArtist extends MpdFrontend{
	
	public $albums = Array();
	
	
	function __construct(){
		parent::__construct();
		
		$artist = $_GET['artist'];
		$this->artist = $artist;
		$this->title = $artist;
		
		$this->albums = $this->mpd->getAlbums($artist);
		$this->tracks = $this->mpd->find(MPD_SEARCH_ARTIST,$artist);
		sort($this->albums);
		sort($this->tracks);
		
		// Add nice track times.
		foreach($this->tracks as &$track){
			$track['Seconds'] = $track['Time'];
			$track['Time'] = gmdate("i:s", $track['Seconds']);
		}
	}
	
}
