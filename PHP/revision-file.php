<?php
require 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $authorId = $_SESSION['id'];
    $aritcleId = $_POST['getArticleId'];
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $middle_name = $_SESSION['middle_name'];
    $userName = $lastName . ' , ' . $firstName .  '  ' . $middle_name;

    // Handle file upload
    $uploadDir = '../Files/submitted-article/';
    $fileName = $_FILES['file_name']['name'];
    $fileType = $_FILES['file_name']['type'];
    $fileTmpName = $_FILES['file_name']['tmp_name'];
    $fileError = $_FILES['file_name']['error'];

    // Check if there is no file error
    if ($fileError === 0) {
        // Move the uploaded file to the desired directory
        $destination = $uploadDir . $fileName;
        move_uploaded_file($fileTmpName, $destination);
    }

    $sqlRevise = "INSERT INTO article_revision_files(`article_id`, `author_id`, `file_type`, `file_name`, `fromuser`, `copyediting`)
    VALUES(:article_id, :author_id, :file_type, :file_name, :fromuser, :copyediting)";

    $sqlParams = array(
        'article_id' => $aritcleId,
        'author_id' => $authorId,
        'file_type' => 'Title page',
        'file_name' => $fileName,
        'fromuser' => $userName,
        'copyediting' => 1
    );

    $sqlLogs = "INSERT INTO logs_article (`article_id`, `user_id`, `fromuser`, `type`) VALUES (:article_id, :user_id, :fromuser, :type)";

    $sqlLogsParams = array(
        'article_id' => $aritcleId,
        'user_id' => $authorId,
        'fromuser' => $userName,
        'type' => 'Edited Article'
    );
    
    database_run($sqlLogs, $sqlLogsParams);

    $sqlRun = database_run($sqlRevise, $sqlParams);
    header("Location: author-dashboard.php");
}else{
    echo 'Editing Article Failed';
}
  

?>
