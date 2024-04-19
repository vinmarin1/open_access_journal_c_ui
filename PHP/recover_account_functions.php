recover_account_functions.php

<?php
require_once 'dbcon.php';
require 'mail.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $_SESSION['userEmail'] = $email;
    $recipient = $email;
    $subject = 'Reset password link';

    // Generate a random token
    $token = bin2hex(random_bytes(32));

    // Save token to session for verification later
    $_SESSION['resetToken'] = $token;

    // Construct reset link with token
    $resetLink = 'https://www.qcuj.online/PHP/recover_account.php?step=3&token=' . $token;

    $emailMessage = 'Click the button below to reset your account password:';
    $emailButton = '<a href="' . $resetLink . '" style="display: inline-block; background-color: #0858A4; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold;">Reset Password</a>';

    $message = '
    <div style="max-width: 600px; margin: 20px auto; font-family: Arial, sans-serif; border: 1px solid #ccc; border-radius: 8px; overflow: hidden;">
        <div style="background-color: #0858A4; color: #ffffff; padding: 20px; text-align: center;">
            <img src="https://qcuj.online/images/qcu-icon-final.png" alt="QCUJ Logo" style="width: 60px;">
            <h1 style="color: #fff; margin-bottom: 10px;">Password Reset</h1>
        </div>
        <div style="padding: 20px; text-align: center;">
            <p style="font-size: 16px; margin-bottom: 20px;">' . $emailMessage . '</p>
            ' . $emailButton . '
        </div>
        <div style="background-color: #f0f0f0; padding: 10px; text-align: center;">
            <p style="font-size: 14px; color: #666; margin-bottom: 10px;">If you did not request a password reset, you can ignore this email.</p>
            <p style="font-size: 14px; color: #666; margin-bottom: 0;">Need help? Contact us at <a href="mailto:qcujournal@gmail.com" style="color: #0858A4; text-decoration: none;">qcujournal@gmail.com</a>.</p>
        </div>
    </div>
    ';

    send_mail($recipient, $subject, $message);
} else {
    echo "Can't find the email address";
}
?>
