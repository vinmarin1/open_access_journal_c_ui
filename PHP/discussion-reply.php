<?php
require_once 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $authorId = $_SESSION['id'];
    $articleId = $_POST['article_id'];
    $userName = $_SESSION['last_name'] . ', ' . $_SESSION['first_name'] . ' ' . $_SESSION['middle_name'];
    $discussionId = $_POST['discussion_id'];
    $message = $_POST['message'];



    $sqlReply = "INSERT INTO discussion_message (discussion_id, userId, fromuser, message, file_type, file)
    VALUES (:discussion_id, :userId, :fromuser, :message, :file_type, :file)";

    $sqlParams = array(
        'discussion_id' => $discussionId,
        'userId' => $authorId,
        'fromuser' => $userName,
        'message' => $message,
        'file_type' => '',
        'file' => ''
    );

    $sqlRun = database_run($sqlReply, $sqlParams);

    if ($sqlRun !== false) {
        echo 'Reply sent successfully';
    } else {
        echo 'Error sending reply';
    }

    $sqlLogs = "INSERT INTO logs_article (`article_id`, `user_id`, `fromuser`, `type`) VALUES (:article_id, :user_id, :fromuser, :type)";

    $sqlLogsParams = array(
        'article_id' => $articleId,
        'user_id' => $authorId,
        'fromuser' => $userName,
        'type' => 'Replied to discussion'
    );
    
    database_run($sqlLogs, $sqlLogsParams);
} else {
    echo 'Invalid request';
}
?>
