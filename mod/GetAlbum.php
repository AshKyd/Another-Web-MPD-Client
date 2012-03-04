<?php

class GetAlbum extends MpdFrontend{
	
	public $album = Array();
	
	function __construct(){
		parent::__construct();
		$album = $_GET['album'];
		$this->album = $album;
		$this->tracks = $this->mpd->find(MPD_SEARCH_ALBUM,$album);
		sort($this->tracks);
		if(count($this->tracks) > 0){
			$this->artist = $this->tracks[0]['Artist'];
		}else{
			$this->artist = '';
		}
		$this->title = "{$this->artist} - {$this->album}";
		$this->breadcrumb[] = array(
			'label' => $this->artist,
			'url' => 'do.php?do=GetArtist&artist='.urlencode($this->artist)
		);
		
		
		$this->toolbarElements[] = array(
			'label' => 'Enqueue Album',
			'class' => 'enqueue-album add',
			'url' => 'do.php?do=EnqueueAlbum&album='.urlencode($this->album)
		);
	}
	
}
