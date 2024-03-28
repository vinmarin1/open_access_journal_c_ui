<?php

require_once 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['id'];
    $answers = $_POST['answers'];
    $article_id = $_POST['getId'];  // Retrieve the article ID

    $sqlAccept = "UPDATE reviewer_assigned
    SET accept = :accept
    WHERE article_id = :article_id AND reviewer_id = :user_id";

    
    $sqlParams = array(
        'accept' => 1,
        'article_id' => $article_id,
        'user_id' => $user_id
    );

    database_run($sqlAccept, $sqlParams);
    

} else {
    echo 'Invalid request.';
}
?>
