<?php
require_once 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $reason = $_POST['reason'];
    $message = $_POST['message'];
    $id = $_SESSION['id'];

    // Check if a file was uploaded
    if(isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] !== UPLOAD_ERR_NO_FILE) {
        // File was uploaded, handle it
        if ($_FILES['upload_file']['error'] === UPLOAD_ERR_OK) {
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

                // Notification insertion code
                $sqlNotif = "INSERT INTO notification(`author_id`, `admin`, `title`, `description`, `read` , `read_user`, `read_notif_list`) VALUES (:author_id, :admin, :title, :description, :read, :read_user, :read_notif_list)";
                $sqlparams = array(
                    'author_id' => $id,
                    'admin' => 1,
                    'title' => $reason,
                    'description' => $message,
                    'read' => 0,
                    'read_user' => 1,
                    'read_notif_list' => 1
                );
                database_run($sqlNotif, $sqlparams);
            } else {
                echo 'Failed to move uploaded file.';
            }
        } else {
            echo 'File upload error.';
        }
    } else {
        // No file was uploaded, proceed without handling the file
        $sql_contact = "INSERT INTO `message` (`name`, `email`, `reason`, `message`) VALUES (:name, :email, :reason, :message)";
        $sql_messages = array(
            'name' => $name,
            'email' => $email,
            'reason' => $reason,
            'message' => $message,
        );

        database_run($sql_contact, $sql_messages);

        $sqlNotif = "INSERT INTO notification(`author_id`, `admin`, `title`, `description`, `read` , `read_user`, `read_notif_list`) VALUES (:author_id, :admin, :title, :description, :read, :read_user, :read_notif_list)";
        $sqlparams = array(
            'author_id' => $id,
            'admin' => 1,
            'title' => $reason,
            'description' => $message,
            'read' => 0,
            'read_user' => 1,
            'read_notif_list' => 1
        );
        database_run($sqlNotif, $sqlparams);

        header('location: contact-us.php');
    }
} else {
    echo 'fail';
}
?>


