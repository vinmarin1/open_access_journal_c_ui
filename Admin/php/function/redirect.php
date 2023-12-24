<?php
include 'dbcon.php';

$author_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

if (empty($author_id)) {
    echo '<script>window.location.href = "../../index.php";</script>';
    exit();
}
?>

