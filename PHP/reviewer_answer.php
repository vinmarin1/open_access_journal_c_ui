<?php
require 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['id'];
    $answers = $_POST['answers'];
    $article_id = $_POST['getId'];  // Retrieve the article ID

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

} else {
    echo 'Invalid request.';
}
?>
