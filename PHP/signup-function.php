<?php

require 'dbcon.php';

header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $mdname = $_POST['mdname'];
    $password = $_POST['password'];
    $lname = $_POST['lname'];
    $privacyPolicy = $_POST['privacyPolicy'];

    $sql = "INSERT INTO author (`first_name`, `last_name`, `middle_name`, `email`, `password`, `privacyAgreement`, `status`)
    VALUES (:first_name, :middle_name, :last_name, :email, :password, :privacyAgreement, :status)";

    $params = array(
        'first_name' => $fname,
        'middle_name' => $lname,
        'last_name' => $mdname,
        'email' => $email,
        'password' => $password,
        'privacyAgreement' => $privacyPolicy,
        'status' => 1
    );

    try {
        database_run($sql, $params, true);
        $response['success'] = true;
        $response['message'] = 'Registration successful!';
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = 'Error: can\'t process your registration. Please try again later.';
    }

    echo json_encode($response);
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
}
?>
