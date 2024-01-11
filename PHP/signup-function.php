<?php

require 'dbcon.php';

header('Content-Type: application/json');

$response = array();

function checkEmailExist($data) {
    $errors = array();

    $checkEmail = database_run("SELECT * FROM author WHERE email = :email LIMIT 1", ['email' => $data['email']]);
    
    if (!empty($checkEmail)) {
        $errors[] = "The email already exists";
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $mdname = $_POST['mdname'];
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);
    $lname = $_POST['lname'];
    $privacyPolicy = $_POST['privacyPolicy'];

    $emailErrors = checkEmailExist($_POST);

    if (!empty($emailErrors)) {
        $response['success'] = false;
        $response['message'] = implode(", ", $emailErrors); 
        echo json_encode($response);
        exit(); 
    }

  
    $sql = "INSERT INTO author (`first_name`, `last_name`, `middle_name`, `email`, `password`, `privacyAgreement`, `status`)
    VALUES (:first_name, :middle_name, :last_name, :email, :password, :privacyAgreement, :status)";

    $params = array(
        'first_name' => $fname,
        'middle_name' => $lname,
        'last_name' => $mdname,
        'email' => $email,
        'password' => $hashedPassword,
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
