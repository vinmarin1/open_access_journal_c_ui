<?php
require_once 'dbcon.php';
require 'mail.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);
    $recipient = $email;
    $subject = 'Change password success';
    $emailMessage = 'We have successfully change your password, to Log-in click <a href="https://www.qcuj.online/PHP/login.php">Click here</a>';

    
    send_mail($recipient, $subject, $emailMessage);

    $sqlUpdatePassword = "UPDATE author SET `password` = :password WHERE email = :email";
    $sqlArray = array(
        'email' => $email,
        'password' => $hashedPassword
    );
    database_run($sqlUpdatePassword, $sqlArray);
    header('Location: https://www.qcuj.online/PHP/logout.php');
} else {
    echo "Failed to update your password";
}
?>
