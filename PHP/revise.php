<?php
require_once 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $authorId = $_SESSION['id'];
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $middle_name = $_SESSION['middle_name'];
    $userName = $lastName . ' , ' . $firstName .  '  ' . $middle_name;
    $aritcleId = $_POST['getArticleId'];
    $fileName = $_POST['fileName'];



    // $sqlRevise = "INSERT INTO article_revision_files(`article_id`, `author_id`, `file_type`, `file_name`, `fromuser`, `copyediting`)
    // VALUES(:article_id, :author_id, :file_type, :file_name, :fromuser, :copyediting)";

    // $sqlParams = array(
    //     'article_id' => $aritcleId,
    //     'author_id' => $authorId,
    //     'file_type' => 'Title page',
    //     'file_name' => 'www-file.docx',
    //     'fromuser' => $userName,
    //     'copyediting' => 1
    // );

    // $sqlRun = database_run($sqlRevise, $sqlParams);

    $sqlUpdate = "UPDATE article SET title = :title, abstract = :abstract WHERE article_id = :article_id";

    $sqlUpdateParams = array(
        'title' => $title,
        'abstract' => $abstract,
        'article_id' => $aritcleId  // Assuming you have a variable $articleId with the article ID
    );
    
    $sqlRunParamsUpdate = database_run($sqlUpdate, $sqlUpdateParams);
    

    $sqlLogs = "INSERT INTO logs_article (`article_id`, `user_id`, `fromuser`, `type`) VALUES (:article_id, :user_id, :fromuser, :type)";

    $sqlLogsParams = array(
        'article_id' => $aritcleId,
        'user_id' => $authorId,
        'fromuser' => $userName,
        'type' => 'Submit Revision'
    );
    
    database_run($sqlLogs, $sqlLogsParams);

    header('Location: author-dashboard.php');
}else{
    echo 'failed to submit';
}

?>