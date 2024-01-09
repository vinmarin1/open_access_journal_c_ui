<?php
require 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    if ($email !== null) {
        $sqlEmail = "INSERT INTO recover_account (`code`, `expires`, `email`) VALUES (:code, :expires, :email)";

        $sqlsParams = array(
            'code' => 123,
            'expires' => 123,
            'email' => $email
        );

        database_run($sqlEmail, $sqlsParams);
    }
}
?>
