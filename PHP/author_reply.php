<?php
require_once 'dbcon.php';
session_start();
require 'mail.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $authorId = $_SESSION['id'];
    $articleId = $_POST['article_id'];
    $userName = $_SESSION['last_name'] . ', ' . $_SESSION['first_name'] . ' ' . $_SESSION['middle_name'];
    $discussionId = $_POST['discussion_id'];
    $message = $_POST['message'];
    $title = $_POST['title'];

    $sqlReply = "INSERT INTO discussion_message(`discussion_id`, `userId`, `fromuser`, `message`)
                 SELECT d.discussion_id, :userId, :fromuser, :message FROM discussion d WHERE d.article_id = :article_id
                 ORDER BY d.discussion_id DESC LIMIT 1";

    $sqlParamsReply = array(
        'article_id' => $articleId,
        'userId' => $authorId,
        'fromuser' => $userName,
        'message' => $message
    );

    database_run($sqlReply, $sqlParamsReply);

    $sqlLogs = "INSERT INTO logs_article (`article_id`, `user_id`, `fromuser`, `type`) VALUES (:article_id, :user_id, :fromuser, :type)";

    $sqlLogsParams = array(
        'article_id' => $articleId,
        'user_id' => $authorId,
        'fromuser' => $userName,
        'type' => 'Replied to discussion'
    );
    
    database_run($sqlLogs, $sqlLogsParams);

    $sqlSendNotif = "INSERT INTO notification(`article_id`, `author_id`, `title`, `description`, `status`, `admin`, `read`, `read_user`, `read_notif_list`) VALUES (:article_id, :author_id, :title, :description, :status, :admin, :read, :read_user, :read_notif_list)";

    $sqlLogsParamsNotif = array(
        'article_id' => $articleId,
        'author_id' => $authorId,
        'title' => $userName .' '. 'Have replied to the discussion regarding the article' .' '. $articleId ,
        'description' => $title,
        'status' => 4,
        'admin' => 0,
        'read' => 0,
        'read_user' => 1,
        'read_notif_list' => 1,
    );
    
    database_run($sqlSendNotif, $sqlLogsParamsNotif);

    $message = "<p>Author, $userName have replied to the discussion regarding to the article:</p></br>
    Title: $title";
    


    $subject = "Replied to the discussion";
    $recipient = 'qcujournal@gmail.com';
    $senderEmail = $email;
    $senderName = $userName;
    
    send_mail($recipient, $subject, $message, $senderEmail, $senderName);

    // Redirect to the appropriate page
    // header("Location: ../PHP/submitted-article.php?id=$articleId");
    // exit(); // Always exit after header redirection
} else {
    echo 'Invalid request';
}
?>
