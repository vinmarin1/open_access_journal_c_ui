<?php
require_once 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['id'];
    $answers = $_POST['answers'];
    $articleId = $_POST['article_id'];
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $middle_name = $_SESSION['middle_name'];
    $userName = $lastName . ' , ' . $firstName .  '  ' . $middle_name;
    
    $sqlReject = "UPDATE reviewer_assigned
                  SET accept = 2
                  WHERE article_id = $articleId
                  AND author_id = $user_id";

    database_run($sqlReject);

} else {
    echo 'Invalid request.';
}
?>
