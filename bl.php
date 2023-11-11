<?php
// Define log file path
require 'settings.php';
header('X-FRAME-OPTIONS: DENY');

if (!isset($_GET['p']) || $_GET['p'] !== PASSWORD) {
    die();
}

// Function to log activity to file
function log_activity($activity) {
    $datetime = (new DateTime())->format(DateTime::ATOM);
    $logEntry = "{$datetime}, action=\"{$activity}\"\n";
    file_put_contents(LOG_FILE, $logEntry, FILE_APPEND);
}

function log_note($note) {
    $datetime = (new DateTime())->format(DateTime::ATOM);
    $logEntry = "{$datetime}, action=\"note\", note=\"{$note}\"\n";
    file_put_contents(LOG_FILE, $logEntry, FILE_APPEND);
}

function valid_activity($value, $activities_file = ACTIVITIES_FILE) {
    $activities = file($activities_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return in_array($value, $activities);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['activity'])) {
        // Handle activity submission
        if (valid_activity($_POST['activity']) && valid_activity($_POST['activity'])) {
            $activity = filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_STRING);
            log_activity($activity);
            $message = $_POST['activity']." logged";
        } else {
            die();
        }
	    
    } elseif (isset($_POST['note'])) {
        // Handle note submission
	    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);
        log_note($note);
        $message = "Note logged";
    }
    $_GET['message'] = $message;
    $queryString = http_build_query($_GET);
    header('Location: '.$_SERVER['PHP_SELF'].'?'.$queryString);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Biologger</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Add viewport meta tag -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Biologger</h2>
    <?php 
        if (!empty($_GET['message'])) {
            $message = urldecode($_GET['message'])
    ?>
        <div class="message"><?= $message ?></div>
    <?php } ?>
<?php
// Check if the file exists and is readable
if (file_exists(ACTIVITIES_FILE) && is_readable(ACTIVITIES_FILE)) {
    // Read the file into an array, one line per array element
    $activities = file(ACTIVITIES_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Create a form and buttons for each activity
    echo '<form method="post">';
    foreach ($activities as $activity) {
        if ($activity === "***") {
            echo '<div class="separator"></div>';
        } else {
            echo '<input type="submit" name="activity" value="' . htmlspecialchars($activity) . '" class="button">';
        }
    }

    echo '</form>';
?>
<div class="form-container">
  <form method="post">
    <input type="text" name="note" class="text-box"> <input type="submit" value="Submit" class="submit-button">
  </form>
</div>
<?
} else {
    echo "The activities file does not exist or is not readable.";
}
?>

<!-- "Show Log" Button -->
<div id="show-log-button">
    <button id="show-log-btn">Show Log</button>
    <button id="home"><a href="<?= $_SERVER['PHP_SELF'].'?p='.PASSWORD ?>" class="biologger-link">Home</a></button>
</div>

<div class="log">
<!-- Container for Logs -->
<div id="log-container" style="display: none;"></div>

    <script>
    // JavaScript to fetch logs
    document.getElementById('show-log-btn').addEventListener('click', function() {
        fetch('get_logs.php?_=' + new Date().getTime())
            .then(response => response.json())
            .then(data => {
                const logContainer = document.getElementById('log-container');
                logContainer.innerHTML = ''; // Clear current logs
                data.forEach(log => {
                    const logEntry = document.createElement('div');
                    logEntry.textContent = log;
                    logContainer.appendChild(logEntry);
                });
                logContainer.style.display = 'block'; // Show logs
                window.scrollBy(0, 400); // Scroll down 400 pixels
            })
            .catch(error => console.error('Error fetching logs:', error));
    });
    </script>

</div>
</div>
</body>
</html>

