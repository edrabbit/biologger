<?php
include_once("settings.php");

function utcnow() {
// Datetimes should always be logged in UTC and sorted out at displaytime
    return date("c");
}

function load_activities($filename) {
// Load valid activities from a text file
	$f = file($filename);
	
	foreach ($f as $x){
		$activities[] = trim($x);
	}
	return $activities;
}

function log_to_file($filename, $event) {
// Log $event to $filename
	$f = fopen($filename, "a+");
	fwrite($f, $event);
	fclose($f);
	return True;
}

?>