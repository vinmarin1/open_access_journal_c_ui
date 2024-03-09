<?php
require 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $authorId = $_SESSION['id'];
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $middleName = $_SESSION['middle_name'];
    $userName = $lastName . ', ' . $firstName . ' ' . $middleName;
    $articleId = $_POST['getArticleId'];
    $title = $_POST['titleInput'];
    $abstract = $_POST['abstract'];
    $fileType = $_POST['selectRevisionFileType'];

    // Check if a file was uploaded successfully
    if ($_FILES['file_name']['error'] == UPLOAD_ERR_OK) {
        $fileName = $_FILES['file_name']['name'];

        // Shorten the article ID hash to 12 characters
        $articleHash = substr(hash('sha256', (string)$articleId), -12);

        // Generate a new file name using the specified format
        $newFileName = "{$articleId}-{$articleHash}-{$fileType}.docx";

        // Move the uploaded file to the desired directory
        $uploadDirectory = "../Files/revision-files/";
        $destination = $uploadDirectory . $newFileName;

        if (move_uploaded_file($_FILES['file_name']['tmp_name'], $destination)) {
            // File move successful, now insert into the database
            $sqlRevise = "INSERT INTO article_revision_files(`article_id`, `author_id`, `file_type`, `file_name`, `fromuser`, `copyediting`)
                VALUES(:article_id, :author_id, :file_type, :file_name, :fromuser, :copyediting)";

            $sqlParams = array(
                'article_id' => $articleId,
                'author_id' => $authorId,
                'file_type' => $fileType,
                'file_name' => $newFileName,
                'fromuser' => $userName,
                'copyediting' => 1
            );

            database_run($sqlRevise, $sqlParams);

          
        
        } else {
            echo 'Error moving the uploaded file to the destination directory.';
        }
    } else {
        echo 'Error uploading the file. Please try again.';
    }
    $sqlUpdate = "UPDATE article SET title = :title, abstract = :abstract WHERE article_id = :article_id";

    $sqlUpdateParams = array(
        'title' => $title,
        'abstract' => $abstract,
        'article_id' => $articleId 
    );
    
    $sqlRunParamsUpdate = database_run($sqlUpdate, $sqlUpdateParams);

    $sqlLogs = "INSERT INTO logs_article (`article_id`, `user_id`, `fromuser`, `type`) VALUES (:article_id, :user_id, :fromuser, :type)";

    $sqlLogsParams = array(
        'article_id' => $articleId,
        'user_id' => $authorId,
        'fromuser' => $userName,
        'type' => 'Revision Article'
    );
    
    database_run($sqlLogs, $sqlLogsParams);

    header("Location: author-dashboard.php");


} else {
    echo 'Editing Article Failed';
}
?>
