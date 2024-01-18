<?php
require 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['id'];
    $answers = $_POST['answers'];
    $article_id = $_POST['getId'];  // Retrieve the article ID
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $middle_name = $_SESSION['middle_name'];
    $userName = $lastName . ' , ' . $firstName .  '  ' . $middle_name;

    $sqlReviewerAnswer = "INSERT INTO reviewer_answer (`article_id`, `author_id`, `reviewer_questionnaire`, `answer`, `round`)
        VALUES (:article_id, :author_id, :reviewer_questionnaire, :answer, 'Round 1')";

    foreach ($answers as $question => $answer) {
        $paramsAnswer = array(
            'article_id' => $article_id,
            'author_id' => $user_id,
            'reviewer_questionnaire' => $question,
            'answer' => $answer,
        );

        database_run($sqlReviewerAnswer, $paramsAnswer);
    }
  
    header('Location: author-dashboard.php');


    $sqlAnswer = "UPDATE reviewer_assigned SET answer = :answer WHERE author_id = :user_id AND article_id = :article_id";

    $sqlUpdateParams = array(
        'answer' => 1,
        'user_id' => $user_id,
        'article_id' => $article_id
    );
    
    database_run($sqlAnswer, $sqlUpdateParams);

    
    $sqlLogs = "INSERT INTO logs_article (`article_id`, `user_id`, `fromuser`, `type`) VALUES (:article_id, :user_id, :fromuser, :type)";

    $sqlLogsParams = array(
        'article_id' => $article_id,
        'user_id' => $user_id,
        'fromuser' => $userName,
        'type' => 'Reviewed Article'
    );
    
    database_run($sqlLogs, $sqlLogsParams);


    

    $sqlAccept = "UPDATE reviewer_assigned SET accept = :accept WHERE author_id = :user_id AND article_id = :article_id";

    $sqlAcceptParams = array(
        'accept' => 1,
        'user_id' => $user_id,
        'article_id' => $article_id
    );

    database_run($sqlAccept, $sqlAcceptParams);
        

} else {
    echo 'Invalid request.';
}
?>
