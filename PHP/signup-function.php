<?php

require 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $fname = $_POST['fname'];
    $mdname = $_POST['mdname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $genSelect = $_POST['genSelect'];
    $bdate = $_POST['bdate'];
    $pnumber = $_POST['pnumber'];
    $aflt = $_POST['aflt'];
    $position = $_POST['position'];
    $expertise = $_POST['expertise'];
    $bio = $_POST['bio'];
    $orcid = $_POST['orcid'];
    $country = $_POST['country'];

    $sql = "INSERT INTO author (`first_name`, `last_name`, `middle_name`, `email`, `password`, `gender`, `birth_date`, `phone_number`, `afiliations`, `position`, `country`, `field_of_expertise`, `bio`, `orc_id`, `role`, `privacyAgreement`) 
            VALUES (:first_name, :last_name, :middle_name, :email, :password, :gender, :birth_date, :phone_number, :afiliations, :position, :country, :field_of_expertise, :bio, :orc_id, :role, :privacyAgreement)";

    $params = array(
        'first_name' => $fname,
        'last_name' => $lname,
        'middle_name' => $mdname,
        'email' => $email,
        'password' => $password,
        'gender' => $genSelect,
        'birth_date' => $bdate,
        'phone_number' => $pnumber,
        'afiliations' => $aflt,
        'position' => $position,
        'country' => $country,
        'field_of_expertise' => $expertise,
        'bio' => $bio,
        'orc_id' => $orcid,
        'role' => 'author',
        'privacyAgreement' => 1
    );



    database_run($sql, $params);
    header('Location: signup.php');

} else {
    echo "Error: can't process your registration";
    exit();
}

?>
