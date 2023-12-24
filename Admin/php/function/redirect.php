<?php
include 'dbcon.php';

$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

if (empty($author_id)) {
    header('Location:../../index.php');
    exit();
}
?>

