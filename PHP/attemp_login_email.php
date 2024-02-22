<?php
require 'dbcon.php';
require 'mail.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $recepient = $email;
    $subject = 'Multiple login attempts';
    $emailMessage = '<p>We have detected multiple login attempts to your account. if this is you and you forgot your account, <a href="https://www.qcuj.online/PHP/login.php">click here</></p>';

    send_mail($recepient, $subject, $emailMessage);
}
?>
