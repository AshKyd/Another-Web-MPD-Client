<?php

class PlayControl extends MpdFrontend{
		
	function __construct(){
		parent::__construct();
		
		switch($_GET['control']){
			case 'playpause':
				if($this->mpd->state == 'play'){
					$this->mpd->Pause();
				}else{
					$this->mpd->Play();
				}
				break;
			case 'stop':
				// Not sure why you'd want this, but whatever.
				$this->mpd->Stop();
				break;
			case 'next':
				$this->mpd->Next();
				break;
			case 'previous':
				$this->mpd->Previous();
				break;
		}


		if(!isset($_GET['json'])){
			// This is the uri the browser says was the last page it was on.
			// Not sure of the security implications here, might need to
			// check it out. FIXME.
			$uri = $this->cookie->uri;
			if(!$uri || $uri == $_SERVER['REQUEST_URI'])
				$uri = 'do.php?do=GetStatus';

			$this->redirect($uri);
		}
	}
}
