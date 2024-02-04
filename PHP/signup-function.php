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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $mdname = $_POST['mdname'];
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);
    $lname = $_POST['lname'];
    $privacyPolicy = $_POST['privacyPolicy'];

    $emailErrors = checkEmailExist($_POST);

    if (!empty($emailErrors)) {
        echo json_encode(['success' => false, 'message' => implode(', ', $emailErrors)]);
        exit();
    }

    $sql = "INSERT INTO author (`first_name`, `last_name`, `middle_name`, `email`, `password`, `privacyAgreement`, `role`, `status`)
            VALUES (:first_name, :middle_name, :last_name, :email, :password, :privacyAgreement, :role, :status)";

    $params = [
        'first_name' => $fname,
        'middle_name' => $lname,
        'last_name' => $mdname,
        'email' => $email,
        'password' => $hashedPassword,
        'privacyAgreement' => $privacyPolicy,
        'role' => 'Author',
        'status' => 1
    ];

    try {
        database_run($sql, $params, true);
        echo json_encode(['success' => true, 'message' => 'Registration successful!']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: can\'t process your registration. Please try again later.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
