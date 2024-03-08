<?php 
require 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $reason = $_POST['reason'];
    $message = $_POST['message'];

    $sql_contact = "INSERT INTO `message` (`name`, `email`, `reason`, `message`) VALUES (:name, :email, :reason, :message)"; 
    $sql_messages = array(
        'name' => $name, 
        'email' => $email,
        'reason' => $reason,
        'message' => $message,
    );
    database_run($sql_contact, $sql_messages);
    header('location: contact-us.php');
} else {
    echo 'fail';
}



