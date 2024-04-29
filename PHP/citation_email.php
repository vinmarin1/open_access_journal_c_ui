<?php
require_once 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $author_id = $_POST['author_id'];
    $title = $_POST['title'];
    $id = $_POST['id'];
    $title1 = 'Intent to Cite Your Article';
   
    
    $description = 'Your article has been cited, ' . $title;
    date_default_timezone_set('Asia/Manila');
    $created = date('Y-m-d H:i:s');
    $admin = 0;

    $sqlNotification = "INSERT INTO notification (`author_id`, `article_id`, `title`, `description`, admin, created) 
    VALUES (:author_id, :article_id, :title, :description, :admin, :created)";

    $paramsNotification = array(
        'author_id' => $author_id,
        'article_id' => $id,
        'title' => $title1,
        'description' => $description,
        'admin' => $admin,
        'created' => $created,
    );

    database_run($sqlNotification, $paramsNotification);
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}
?>
