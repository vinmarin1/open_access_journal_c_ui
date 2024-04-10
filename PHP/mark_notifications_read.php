<?php
// Include your database connection or any required files
require_once 'dbcon.php';
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the author_id from the POST data
    $author_id = isset($_POST['author_id']) ? $_POST['author_id'] : null;
    
    // Debug information to see the received author_id
    echo "Received author_id: $author_id";
    
    // Check if the author_id is valid
    if ($author_id !== null) {
        // Update notifications as read for the current user
        $sqlUpdateRead = "UPDATE `notification` SET `read_user` = 1 WHERE `author_id` = :author_id AND `read_user` = 0";
        $params = array(':author_id' => $author_id);
        
        // Execute the update query
        $result = database_run($sqlUpdateRead, $params);

        // Check if the update was successful
        if ($result !== false) {
            // Return a success message or any response you want
            echo "Notifications marked as read successfully.";
        } else {
            // Return an error message if the update failed
            echo 'Error marking notifications as read.';
        }
    } else {
        // Handle invalid author_id
        echo 'Invalid author_id.';
    }
} else {
    // Handle invalid requests
    echo 'Invalid request.';
}
?>
