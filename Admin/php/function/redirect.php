<?php
include 'dbcon.php';

session_start();
$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

if (empty($author_id)) {

    header('Location:../../php/login.php');
    exit(); 
}
?>
