<?php
require_once 'dbcon.php';
require 'mail.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $author_id = $_POST['author_id'];
    $title = $_POST['title'];
    $id = $_POST['id'];
    $title1 = 'Article Cited';
    $description = 'Your article has been cited by ' . $name .', ' . $title;
    date_default_timezone_set('Asia/Manila');
    $created = date('Y-m-d H:i:s');
    $admin = 1;

    $sqlNotification = "INSERT INTO notification (`author_id`, `article_id`, `title`, `description`, admin, created) 
    VALUES (:author_id, :article_id, :title, :description, :admin, :created)";

    $paramsNotification = array(
        'author_id' => 162,
        'article_id' => $id,
        'title' => $title1,
        'description' => $description,
        'admin' => $admin,
        'created' => $created,
    );

    database_run($sqlNotification, $paramsNotification);

    
    $subject = 'Article Citation Notification';
    $emailMessage = "<p>Your article with title '$title' (ID: $id) has been cited.</p>";
    
    // Send email
    send_mail($email, $subject, $emailMessage);
    
    // Respond to the client
    echo "Email sent successfully.";
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}
?>
