<?php
require_once 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $reason = $_POST['reason'];
    $message = $_POST['message'];

    // Check if file was uploaded without errors
    if(isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] === UPLOAD_ERR_OK) {
        $upload_file = $_FILES['upload_file']['name'];
        $upload_path = '../Files/message-image/' . $upload_file;

        // Move uploaded file to desired location
        if(move_uploaded_file($_FILES['upload_file']['tmp_name'], $upload_path)) {
            // File uploaded successfully, proceed with database insertion
            $sql_contact = "INSERT INTO `message` (`name`, `email`, `reason`, `message`, `upload_file`) VALUES (:name, :email, :reason, :message, :upload_file)";
            $sql_messages = array(
                'name' => $name,
                'email' => $email,
                'reason' => $reason,
                'message' => $message,
                'upload_file' => $upload_file,
            );

            database_run($sql_contact, $sql_messages);
            header('location: contact-us.php');
        } else {
            echo 'Failed to move uploaded file.';
        }
    } else {
        echo 'File upload error.';
    }
} else {
    echo 'fail';
}
?>
