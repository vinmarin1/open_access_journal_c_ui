
<?php
require 'dbcon.php';
session_start();


if (isset($_POST['notification_id'])) {
    $notificationId = $_POST['notification_id'];
    $id = $_SESSION['id'];
    // Perform the database update to mark the notification as read
    $sqlUpdate = "UPDATE notification SET read_notif_list = 1 WHERE id = :id AND author_id = :author_id";
    $paramsUpdate = array(':id' => $notificationId, ':author_id' => $id);
    $updateResult = database_run($sqlUpdate, $paramsUpdate);

    if ($updateResult !== false) {
        // Return a success response
        echo json_encode(array('success' => true));
    } else {
        // Return an error response
        echo json_encode(array('success' => false, 'error' => 'Database update failed'));
    }
} else {
    // Return an error response if notification_id is not provided
    echo json_encode(array('success' => false, 'error' => 'Notification ID not provided'));
}


?>