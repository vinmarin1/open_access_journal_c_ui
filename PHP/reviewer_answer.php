<?php
require 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $answers = $_POST['answers'];
    $article_id = $_POST['getId'];  // Retrieve the article ID
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $middle_name = $_SESSION['middle_name'];
    $userName = $lastName . ' , ' . $firstName .  '  ' . $middle_name;
    $getRound = $_POST['getRound'];
    $ansOrig = $_POST['ansOrig'];
    // $ansRef = $_POST['ansRef'];
    // $ansLang = $_POST['ansLang'];

    $sqlReviewerAnswer = "INSERT INTO reviewer_answer (`article_id`, `author_id`, `reviewer_questionnaire`, `answer`, `round`)
        VALUES (:article_id, :author_id, :reviewer_questionnaire, :answer, :round)";

    foreach ($answers as $question => $answer) {
        $paramsAnswer = array(
            'article_id' => $article_id,
            'author_id' => $user_id,
            'reviewer_questionnaire' => $question,
            'answer' => $answer,
            // 'comment' => $ansOrig,
            // 'reference' => $ansRef,
            // 'languages' => $ansLang,
            'round' => $getRound
        );

        database_run($sqlReviewerAnswer, $paramsAnswer);
    }
  
    

    $sqlUpdate = "UPDATE reviewer_assigned SET answer = :answer, accept = :accept, comment = :comment, decision = :decision WHERE author_id = :user_id AND article_id = :article_id ORDER BY date_issued DESC LIMIT 1";


    $lastAnswer = end($answers); 

    $paramsUpdate = array(
    'answer' => 1,
    'accept' => 1,
    'comment' => $ansOrig,
    'decision' => $lastAnswer, 
    'user_id' => $user_id,
    'article_id' => $article_id
    );

    database_run($sqlUpdate, $paramsUpdate);
        
    $sqlLogs = "INSERT INTO logs_article (`article_id`, `user_id`, `fromuser`, `type`) VALUES (:article_id, :user_id, :fromuser, :type)";

    $sqlLogsParams = array(
        'article_id' => $article_id,
        'user_id' => $user_id,
        'fromuser' => $userName,
        'type' => 'Reviewed Article'
    );
    
    database_run($sqlLogs, $sqlLogsParams);


    

    // $sqlAccept = "UPDATE reviewer_assigned SET accept = :accept WHERE author_id = :user_id AND article_id = :article_id";

    // $sqlAcceptParams = array(
    //     'accept' => 1,
    //     'user_id' => $user_id,
    //     'article_id' => $article_id
    // );

    // database_run($sqlAccept, $sqlAcceptParams);

    $sqlPoint = "INSERT INTO user_points(`user_id`, `email`, `action_engage`, `article_id`, `point_earned`) VALUES (:user_id, :email, :action_engage, :article_id, :point_earned)";

    $logsPoints = array(
        'user_id' => $user_id,
        'email' => $email,
        'action_engage' => 'Reviewed an Article',
        'article_id' => $article_id,
        'point_earned' => 1
    );
      
    database_run($sqlPoint, $logsPoints);

        
    header('Location: author-dashboard.php');

} else {
    echo 'Invalid request.';
}
?>
