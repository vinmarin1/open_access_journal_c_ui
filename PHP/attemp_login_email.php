<?php
require_once 'dbcon.php';
require 'mail.php';

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $recepient = $email;
    $subject = 'Multiple login attempts';
    $emailMessage = '<p>We have detected multiple login attempts to your account. If this is you and you forgot your account, <a href="https://www.qcuj.online/PHP/login.php">click here</a></p>';

    send_mail($recepient, $subject, $emailMessage);
    date_default_timezone_set('Asia/Manila');
        
    $currentDateTime = new DateTime();

    $currentDateTime->add(new DateInterval('PT60S'));
    
    $advanceDateTimeStr = $currentDateTime->format('Y-m-d H:i:s');

    $sql = "INSERT INTO login_attempt (`email`, `attempt`, `date`) VALUES (:email, :attempt, :date)";
    $params = array(
        'email' => $email,
        'attempt' => 3,
        'date' => $advanceDateTimeStr 
    );

    database_run($sql, $params);
}
?>
