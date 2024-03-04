<?php
require 'dbcon.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pointsToDeduct = isset($_POST['points']) ? intval($_POST['points']) : 0;

   
    $userId = $_SESSION['id'];
    $sqlDeduct = "UPDATE support_points SET points = points - :points WHERE user_id = :userId";
    $varsDeduct = array(':points' => $pointsToDeduct, ':userId' => $userId);
    database_run($sqlDeduct, $varsDeduct);

    echo 'Success'; 


} else {
    echo 'Invalid request';
}
?>
