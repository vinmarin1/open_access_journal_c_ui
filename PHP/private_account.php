<?php
require_once 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_SESSION['id'];

    $sql = "UPDATE author SET public_private_profile = :public_private_profile WHERE author_id = :author_id";
    $params = array(
        'public_private_profile' => 1,
        'author_id' => $id
    );

    database_run($sql, $params);
    header('Location: user-account.php');
}
?>
