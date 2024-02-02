<?php
require 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['id'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];
    $country = $_POST['country'];
    $orcid = $_POST['orcid'];
    $affiliation = $_POST['affiliation'];
    $position = $_POST['position'];
    $affix = $_POST['affix'];
    $bio = $_POST['bio'];

    $sqlUpdateUserInfo = "UPDATE author SET first_name = :first_name, affix = :affix, middle_name = :middle_name, last_name = :last_name, gender = :gender, status = :status, country = :country, afiliations = :afiliations, bio = :bio, position = :position, orc_id = :orc_id WHERE author_id = :author_id";
    $sqlArray = array(
        'first_name' => $firstName,
        'affix' => $affix,
        'middle_name' => $middleName,
        'last_name' => $lastName,
        'gender' => $gender,
        'status' => $status,
        'country' => $country,
        'afiliations' => $affiliation,
        'position' => $position,
        'author_id' => $user_id,
        'orc_id' => $orcid,
        'bio' => $bio
    );

    database_run($sqlUpdateUserInfo, $sqlArray);
    header('location: logout.php');
} else {
    echo 'fail';
}
?>
