<?php
require_once 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $otp = isset($_POST['otp']) ? $_POST['otp'] : null;

    if ($otp !== null) {
        $sqlCheckOtp = "SELECT `expires` FROM recover_account WHERE `code` = :otp";
        $sqlParams = array('otp' => $otp);
        $result = database_run($sqlCheckOtp, $sqlParams, true);

        if ($result) {
            $expires = strtotime($result['expires']);
            $currentTimestamp = time();

            if ($expires > $currentTimestamp) {
                echo 'valid';
            } else {
                echo 'expired';
            }
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>


