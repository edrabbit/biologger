<?php
include_once("settings.php");
error_reporting(E_ERROR);

function utcnow() {
// Datetimes should always be logged in UTC and sorted out at displaytime
    return date("c");
}

function load_activities($filename, $sort=True) {
// Load valid activities from a text file
	$f = file($filename);
	$activites = array();
	foreach ($f as $x){
		$activities[] = trim($x);
	}
	if ($sort) {
	    @sort($activities);
	}
	return $activities;
}

function log_to_file($filename, $event) {
// Log $event to $filename
	$f = fopen($filename, "a+");
	if (fwrite($f, $event)) {
            fclose($f);
            return True;
        } else {
	    fclose($f);
	    return False;
        }
}

function is_one_touch($activity) {
    $one_touches = load_activities(ONE_TOUCHES_FILE);
    if (in_array($activity, $one_touches)) {
        return True;
    } else {
        return False;
    }
}

?>
