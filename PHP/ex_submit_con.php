<?php
require 'dbcon.php';

session_start();

if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
    $id = $_SESSION['id'];
    echo "<p id='author_id' style='display: none'>$id</p>";
    
    $firstName = isset($_SESSION['first_name']) ? ucfirst($_SESSION['first_name']) : '';
    $middleName = isset($_SESSION['middle_name']) ? ' ' . ucfirst($_SESSION['middle_name']) : '';
    $lastName = isset($_SESSION['last_name']) ? ' ' . ucfirst($_SESSION['last_name']) : '';
    $contributor = $firstName . $middleName . $lastName;
    echo "<p id='contributor' style='display: none'>$contributor</p>";
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $privacy = $_POST['check'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $keywords = $_POST['keywords'];
    $reference = $_POST['reference'];
    $journal_id = $_POST['journal-type'];
    $comment = $_POST['notes'];
    
    $author_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : null;
    $contributor = (isset($_SESSION['first_name'])) ? $_SESSION['first_name'] : null;

    if ($author_id === null && $contributor){
        echo 'Can\'t find information about this user.';
        exit();
    }

    // Check if file upload is successful
    if (!empty($_FILES['file_name']['name'])) {
        // Process the file upload
        $file_name = $_FILES['file_name']['name'];

        // Insert into article table
        $sql = "INSERT INTO article (`author`, `privacy`, `title`, `journal_id`, `author_id`, `abstract`, `keyword`, `references`, `comment`, `status`)
        VALUES (:author, :privacy, :title, :journal_id, :author_id, :abstract, :keyword, :references, :comment, :status)";

        $params = array(
            'author' => $contributor,
            ':privacy' => $privacy,
            'title' => $title,
            ':journal_id' => $journal_id,
            ':author_id' => $author_id,
            ':abstract' => $abstract,
            ':keyword' => $keywords,
            ':references' => $reference,
            'comment' => $comment,
            'status' => "4"
        );

        // Use the modified function with $isInsert set to true
        $lastInsertedArticleId = database_run($sql, $params, true);

        // Move the uploaded file to a specific folder
        $uploadDirectory = "../Files/submitted-article"; // Change this to the actual path
        $targetFilePath = $uploadDirectory . $file_name;

        if (move_uploaded_file($_FILES['file_name']['tmp_name'], $targetFilePath)) {
            // Insert into example_files table with the retrieved article_id
            $files_sql = "INSERT INTO example_files (article_id, file_name) VALUES (:article_id, :file_name)";
            $files_params = array(
                ':article_id' => $lastInsertedArticleId,
                ':file_name' => $file_name
            );

            database_run($files_sql, $files_params);

            Header("Location: ex_submit.php");
            exit();
        } else {
            echo 'Error: Failed to move the uploaded file.';
            exit();
        }
    } else {
        echo 'Error: No file uploaded.';
        exit();
    }
} else {
    echo 'Error: Invalid request method.';
    exit();
}
?>
