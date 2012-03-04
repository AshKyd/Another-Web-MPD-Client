<?php

class MpdFrontend{
	function __construct(){
		$this->mpd = new mpd('localhost',6600);
		$this->title = 'Untitled';
		$this->breadcrumb = array();
		$this->toolbarElements = array();
		$this->message = false;
		if(!$this->mpd->connected){
			die(json_encode(array(
				'error' => 'Could not connect to MPD.'
			)));
		}
		$this->loadCookie();
	}
	
	function addMessage($message,$class='note'){
		//FIXME: Broken, never shows up.
		$this->message = new stdClass();
		$this->message->message = $message;
		$this->message->msgclass = $class;
	}
	
	function redirect($target){
		header('Location: '.$target);
		die();
	}
	
	function loadCookie(){
		if(isset($_COOKIE['mpdsession'])){
			$this->cookie = json_decode($_COOKIE['mpdsession']);
			if(!is_object($this->cookie))
				$this->cookie = new stdClass();
		} else {
			$this->cookie = new stdClass();
		}
		
		if(isset($this->cookie->message)){
			$this->message = $this->cookie->message;
			$this->cookie->message = false;
		}
	}
	function setCookie(){
		$this->cookie->uri = $_SERVER['REQUEST_URI'];
		$this->cookie->message = $this->message;
		
		$cookie = json_encode($this->cookie);
		setCookie('mpdsession',$cookie);
	}
	
}
