<?php

class EnqueueAlbum extends GetAlbum{
		
	function __construct(){
		parent::__construct();
		
		$playlist = array();
		foreach($this->tracks as &$track){
			$playlist[] = $track['file'];
		}

		if(is_null($this->mpd->PLAddBulk($playlist))){
			$this->addMessage('Could not add items to playlist. '.$this->mpd->errStr,'error');
		} else {
			$this->addMessage('Added '.count($playlist).' songs to playlist.');
		}
			
		if(!isset($_GET['json'])){
			$this->redirect('do.php?do=GetAlbum&album='.urlencode($this->album));
		}
	}
}
