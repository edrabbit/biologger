<?php
// Define log file path
require 'settings.php';
function get_last_log_entries() {
    $lines = array_slice(file(LOG_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES), -1000);
    return array_reverse($lines); // Newest entries first
}

header('Content-Type: application/json');
echo json_encode(get_last_log_entries());

?>
