<?php
require 'dbcon.php';
require 'mail.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $_SESSION['userEmail'] = $email;
    $recipient = $email;
    $subject = 'Reset password link';
    $emailMessage = 'Here\'s the reset link for your account <a href="http://localhost/open_access_journal_c_ui/PHP/recover_account.php?step=3">Click here</a>';

    
    send_mail($recipient, $subject, $emailMessage);
} else {
    echo "Can't find the email address";
}
?>
