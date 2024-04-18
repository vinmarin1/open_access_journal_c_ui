<?php
require_once 'dbcon.php';
require 'mail.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $oldPassword = $_POST['oldPassword']; 
    $newPassword = $_POST['password'];
    $hashedNewPassword = hash('sha256', $newPassword);

    // Check if the old password matches
    $sqlGetOldPassword = "SELECT `password` FROM author WHERE email = :email";
    $storedPassword = database_run($sqlGetOldPassword, ['email' => $email]);

    if ($storedPassword && count($storedPassword) > 0) {
        $hashedStoredPassword = $storedPassword[0]->password;
        if (hash('sha256', $oldPassword) !== $hashedStoredPassword) {
            echo json_encode(['success' => false, 'message' => 'You inputted wrong password']);
            exit; // Stop further execution
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch stored password']);
        exit; // Stop further execution
    }

    // Check if the new password is the same as the old one
    if ($hashedNewPassword === $hashedStoredPassword) {
        echo json_encode(['success' => false, 'message' => 'Password must not be the same as the old one']);
        exit; // Stop further execution
    }

    // Proceed to update the password
    $sqlUpdatePassword = "UPDATE author SET `password` = :password WHERE email = :email";
    $sqlArray = array(
        'email' => $email,
        'password' => $hashedNewPassword
    );
    database_run($sqlUpdatePassword, $sqlArray);

    // Send email notification
    $recipient = $email;
    $subject = 'Change password success';
    $emailMessage = 'We have successfully changed your password. To log in, click <a href="https://www.qcuj.online/PHP/change_pass.php">here</a>';
    send_mail($recipient, $subject, $emailMessage);

    echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
    header('Location: logout.php');
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
