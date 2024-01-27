<?php
require 'dbcon.php';
require 'mail.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $code = rand(10000, 99999);

    if ($email !== null) {
       
        $sqlEmail = "INSERT INTO recover_account (`code`, `expires`, `email`) VALUES (:code, DATE_ADD(NOW(), INTERVAL 1 MINUTE), :email)";

        $sqlsParams = array(
            'code' => $code,
            'email' => $email
        );

        database_run($sqlEmail, $sqlsParams);

        $emailUser = $email;

        $message = '
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    .container {
                        background-color: #fff;
                        border-radius: 5px;
                        padding: 20px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    h2 {
                        color: #333;
                    }
                    p {
                        color: #555;
                    }
                    .code {
                        font-size: 24px;
                        font-weight: bold;
                        color: #007bff;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <p>Hello, ' . $emailUser . '</p>
                    <p>Here\'s your 5-digit code for your account recovery:</p>
                    <p class="code">' . $code . '</p>
                </div>
            </body>
            </html>
        ';

        $subjectCont = "Recovery Account";
        $recipientCont = $emailUser;

       
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
