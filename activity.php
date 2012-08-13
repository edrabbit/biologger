<?php

include_once('fxns.php');
$activities = load_activities(ACTIVITIES_FILE);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
	<link href="iwebkit/css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script src="iwebkit/javascript/functions.js" type="text/javascript"></script>
	<title>Biologger</title>
</head>

<body>
<div id="topbar" class="black"><div id="title">Biologger</div></div>
<div id="content">
	<form method="post" action="count.php">
		<span class="graytitle">Activity</span>
		<ul class="pageitem">
			<li class="select">
				<select name="activity_type">
					<?php
					$selected = False;
					foreach ($activities as $act) {
						if (!$selected) {
							print '<option value="'.$act.'" selected="selected">'.$act.'</option>';
							$selected = True;
						} else {
							print '<option value="'.$act.'">'.$act.'</option>';
						}
					}
					?>
    			</select>
 			</li>
		</ul>

		<ul class="pageitem">
			<li class="bigfield"><input placeholder="Count" name="count" type="tel" /></li>
		</ul>
		<ul class="pageitem">
  			<li class="button"><input name="Submit" type="submit" value="Submit" /></li>
		</ul>
	</form>
</div>

<div id="footer"></div>

</body>
</html>
