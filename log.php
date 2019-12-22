<ul>
<?php
include_once('fxns.php');
$lines = file(ACTIVITIES_LOG_FILE);
$lines = array_reverse($lines);
foreach ($lines as $line_num => $line) {
    $event = explode(' ',htmlspecialchars($line), 2);
    echo "<li style=\"font-size:8px\">" . htmlspecialchars($line) . "</li>";
}
?>
</ul>
