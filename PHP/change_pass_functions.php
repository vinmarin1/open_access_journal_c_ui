<?php
require_once 'dbcon.php';
require 'mail.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $_SESSION['userEmail'] = $email;
    $recipient = $email;
    $subject = 'Update Password Link';

    // Generate a random token
    $token = bin2hex(random_bytes(32));

    // Save token to session for verification later
    $_SESSION['resetToken'] = $token;

    // Construct reset link with token
    $resetLink = 'https://www.qcuj.online/PHP/change_pass.php?step=3&token=' . $token;

    $emailMessage = 'Here\'s the reset link for your account: <a href="' . $resetLink . '">Click here</a>';

    send_mail($recipient, $subject, $emailMessage);
} else {
    echo "Can't find the email address";
}
?>
