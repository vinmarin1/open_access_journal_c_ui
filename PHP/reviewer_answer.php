<?php
require 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['id'];
    $answers = $_POST['answers'];

    $sqlReviewerAnswer = "
        INSERT INTO reviewer_answer (`article_id`, `author_id`, `reviewer_questionnaire`, `answer`, `round`)
        SELECT article.article_id, :author_id, :reviewer_questionnaire, :answer, 'Round 1'
        FROM article
        JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id
        WHERE article.status = 5 AND reviewer_assigned.author_id = :author_id
    ";

    foreach ($answers as $question => $answer) {
        $paramsAnswer = array(
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
