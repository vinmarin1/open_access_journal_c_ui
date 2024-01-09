<?php
require 'dbcon.php';
require 'mail.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $code = rand(10000, 99999);

    if ($email !== null) {
        // Set the expiration time to 1 minute from the current time using the database server's time
        $sqlEmail = "INSERT INTO recover_account (`code`, `expires`, `email`) VALUES (:code, DATE_ADD(NOW(), INTERVAL 1 MINUTE), :email)";

        $sqlsParams = array(
            'code' => $code,
            'email' => $email
        );

        database_run($sqlEmail, $sqlsParams);

        $emailUser = $email;

        $message = "<p>Hello, $emailUser! Here's your 5-digit code for your account recovery: $code</p>";

        $subjectCont = "Recovery Account";
        $recipientCont = $emailUser;

        // Assuming send_mail function returns true on success
        if (send_mail($recipientCont, $subjectCont, $message)) {
            echo 'success';
        } else {
            echo 'error sending email';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
