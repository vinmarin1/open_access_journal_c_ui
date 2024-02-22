<?php
require 'dbcon.php';
require 'mail.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);
    $recipient = $email;
    $subject = 'Change password success';
    $emailMessage = 'We have successfully change your password, to Log-in click <a href="http://localhost/open_access_journal_c_ui/php/login.php">Click here</a>';

    
    send_mail($recipient, $subject, $emailMessage);

    $sqlUpdatePassword = "UPDATE author SET `password` = :password WHERE email = :email";
    $sqlArray = array(
        'email' => $email,
        'password' => $hashedPassword
    );
    database_run($sqlUpdatePassword, $sqlArray);
} else {
    echo "Failed to update your password";
}
?>
