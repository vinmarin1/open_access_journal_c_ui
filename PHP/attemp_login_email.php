<?php
require 'dbcon.php';
require 'mail.php';

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $recepient = $email;
    $subject = 'Multiple login attempts';
    $emailMessage = '<p>We have detected multiple login attempts to your account. If this is you and you forgot your account, <a href="https://www.qcuj.online/PHP/login.php">click here</a></p>';

    send_mail($recepient, $subject, $emailMessage);


    $currentDateTime = date('Y-m-d h:i:s A');

    $sql = "INSERT INTO login_attempt (`email`, `attempt`, `date`) VALUES (:email, :attempt, :date)";
    $params = array(
        'email' => $email,
        'attempt' => 3,
        'date' => $currentDateTime 
    );

    database_run($sql, $params);
}
?>
