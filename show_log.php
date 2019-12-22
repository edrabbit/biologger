<?php

include_once('fxns.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
	<link rel="apple-touch-startup-image" href="img/splashscreen.png">
	<link href="iwebkit/css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script src="iwebkit/javascript/functions.js" type="text/javascript"></script>
	<title>Biologger</title>
</head>

<body>

<div id="topbar" class="black"><div id="title">Biologger</div></div>
<div id="content">
	<span class="center"><span class="greytitle">Log</span></span>
<?php include("log.php"); ?>
</div>

</body>
</html>
