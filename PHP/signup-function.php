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

function checkOrcid($data) {
    $errors = array();

    $checkOrcid = database_run("SELECT * FROM author WHERE orc_id = :orc_id LIMIT 1", ['orc_id' => $data['orcid']]);
    
    if (!empty($checkOrcid)) {
        $errors[] = "The ORCID already exists";
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $orcid = $_POST['orcid'];
    $fname = $_POST['fname'];
    // $mdname = $_POST['mdname'];
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);
    $lname = $_POST['lname'];
    $privacyPolicy = $_POST['privacyPolicy'];

    $emailErrors = checkEmailExist($_POST);
    $orcidErrors = checkOrcid($_POST);

    if (!empty($emailErrors) && !empty($orcidErrors)) {
        echo json_encode(['success' => false, 'message' => implode(', ', $emailErrors) . ', ' . implode(', ', $orcidErrors)]);
    } elseif (!empty($emailErrors)) {
        echo json_encode(['success' => false, 'message' => implode(', ', $emailErrors)]);
    } elseif (!empty($orcidErrors)) {
        echo json_encode(['success' => false, 'message' => implode(', ', $orcidErrors)]);
    } else {
        // Your insertion code here
        $sql = "INSERT INTO author (`first_name`, `last_name`, `email`, `orc_id`, `password`, `privacyAgreement`, `role`, `status`)
            VALUES (:first_name, :last_name, :email, :orc_id, :password, :privacyAgreement, :role, :status)";

        $params = [
            'first_name' => $fname,
            // 'middle_name' => $lname,
            'last_name' => $lname,
            'email' => $email,
            'orc_id' => $orcid,
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
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
