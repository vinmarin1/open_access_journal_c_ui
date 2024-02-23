<?php
require 'dbcon.php';
require 'mail.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $_SESSION['userEmail'] = $email;
    $recipient = $email;
    $subject = 'Reset password link';
    $emailMessage = 'Here\'s the reset link for your account <a href="https://www.qcuj.online/PHP/recover_account.php?step=3">Click here</a>';

    
    send_mail($recipient, $subject, $emailMessage);
} else {
    echo "Can't find the email address";
}
?>
