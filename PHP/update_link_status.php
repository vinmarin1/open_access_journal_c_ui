<?php
require_once 'dbcon.php';

// Check if token is provided
if (isset($_POST['token'])) {
    $token = $_POST['token'];

    // Update token status to used
    $sqlUpdate = "UPDATE reset_tokens SET used = 1 WHERE token = :token";
    $paramsUpdate = array(
        'token' => $token
    );
    database_run($sqlUpdate, $paramsUpdate);

    // Send response
    http_response_code(200);
    echo "Token marked as used";
} else {
    // Token not provided
    http_response_code(400);
    echo "Token not provided";
}
?>
