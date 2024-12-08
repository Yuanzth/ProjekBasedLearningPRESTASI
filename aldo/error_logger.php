<?php
function logError($error) {
    // Lokasi file log
    $logFile = 'logs/error_log.txt';

    // Format waktu
    $timestamp = date('Y-m-d H:i:s');

    // Format pesan error
    if (is_array($error)) {
        $errorMessage = '';
        foreach ($error as $err) {
            $errorMessage .= "SQLSTATE: {$err['SQLSTATE']}, Code: {$err['code']}, Message: {$err['message']}\n";
        }
    } else {
        $errorMessage = $error;
    }

    // Format pesan log
    $logMessage = "[$timestamp] $errorMessage\n";

    // Tambahkan ke file log
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

?>
