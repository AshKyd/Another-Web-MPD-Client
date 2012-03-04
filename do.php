<?php
if(isset($_GET['debug'])){
	ini_set('display_errors',1); 
	error_reporting(E_ALL);
}

function __autoload($class){
	$filename = "mod/$class.php";
	if(file_exists($filename)){
		require_once $filename;
	}
}

include 'lib/mpd/mpd.class.php';

$action = $_GET['do'];
$obj = new $action();
$obj->setCookie();

if(isset($_GET['json'])){
	header('content-type:text/plain');
	$json = json_encode($obj);
	echo($json);
}else{
	$template = "templates/$action.mustache";
	if(!file_exists($template)){
		trigger_error("Template $template not found");
	} else {
		$bodyTemplate = file_get_contents($template);
	}
	$htmlTemplate = file_get_contents('templates/main.mustache');
	
	require_once 'lib/mustache.php/Mustache.php';
	$m = new Mustache;
	
	// Merge the body template into the main template.
	$htmlTemplate = str_replace('{{{content}}}',$bodyTemplate,$htmlTemplate);
	
	$content = $m->render($htmlTemplate,$obj);
	
	echo($content);
}

$obj->mpd->Disconnect();
