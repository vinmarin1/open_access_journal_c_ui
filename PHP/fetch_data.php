<?php
require 'dbcon.php';
session_start();
$id = $_SESSION['id'];

$sqlCount = "SELECT email FROM user_points WHERE user_id = :user_id";
$result = database_run($sqlCount, array(':user_id' => $id));

if ($result !== false) {
    $resultCount = count($result);
    echo $resultCount;
} else {
    echo "Unable to fetch user info.";
}

?>