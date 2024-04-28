<?php
require_once 'dbcon.php';
session_start();
require 'mail.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $authorId = $_SESSION['id'];
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $middleName = $_SESSION['middle_name'];
    $email = $_SESSION['email'];
    $userName = $lastName . ', ' . $firstName . ' ' . $middleName;
    $articleId = $_POST['getArticleId'];
    $title = $_POST['titleInput'];
    $abstract = $_POST['abstract'];
    $fileType = $_POST['selectRevisionFileType'];
    // $messageTextarea = $_POST['messageTextarea'];

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


            $sqlReply = "INSERT INTO discussion_message(`discussion_id`, `userId`, `fromuser`, `file_type`, `file`)
            SELECT d.discussion_id, :userId, :fromuser, :file_type, :file FROM discussion d WHERE d.article_id = :article_id
            ORDER BY d.discussion_id DESC LIMIT 1";
        
        
            $sqlParamsReply = array(
                'article_id' => $articleId,
                'userId' => $authorId,
                'fromuser' => $userName,
                'file_type' => $fileType,
                'file' => $newFileName,
            );
            
            database_run($sqlReply, $sqlParamsReply);
        

          
        
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

    // $sqlSendNotif = "INSERT INTO notification(`article_id`, `author_id`, `title`, `description`, `status`, `admin`, `read`, `read_user`, `read_notif_list`) VALUES (:article_id, :author_id, :title, :description, :status, :admin, :read, :read_user, :read_notif_list)";

    // $sqlLogsParamsNotif = array(
    //     'article_id' => $articleId,
    //     'author_id' => $authorId,
    //     'title' => $userName .' '. 'Have replied to the discussion regarding the article' .' '. $articleId ,
    //     'description' => $title,
    //     'status' => 4,
    //     'admin' => 0,
    //     'read' => 0,
    //     'read_user' => 1,
    //     'read_notif_list' => 1,
    // );
    
    // database_run($sqlSendNotif, $sqlLogsParamsNotif);

    // $message = "<p>Author, $userName have replied to the discussion regarding to the article:</p></br>
    // Title: $title";
    


    // $subject = "Replied to the discussion";
    // $recipient = 'qcujournal@gmail.com';
    // $senderEmail = $email;
    // $senderName = $userName;
    
    // send_mail($recipient, $subject, $message, $senderEmail, $senderName);
    

    header("Location: ../PHP/submitted-article.php?id=$articleId");


} else {
    echo 'Editing Article Failed';
}
?>
