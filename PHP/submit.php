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
    echo "<p id='contributor' style='display: none'>$contributor
    </p>";
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $privacy = $_POST['privacy'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $keyword = $_POST['keyword'];
    $reference = $_POST['reference'];
    $category = $_POST['category']; 
    $comment = $_POST['comment'];

    
 

    $author_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : null;
    $contributor = (isset($_SESSION['first_name'])) ? $_SESSION['first_name'] : null;

    if ($author_id === null && $contributor){
        echo 'Cant find information about this user.';
        exit();
    }
    

    $sql = "INSERT INTO article (author, privacy, title, journal_id, author_id, abstract, keyword, `references`, comment)
    VALUES (:author, :privacy, :title, :journal_id, :author_id, :abstract, :keyword, :references, :comment)";


    $params = array(
        'author' => $contributor,
        ':privacy' => $privacy,
        'title' => $title,
        ':journal_id' => $category,
        ':author_id' => $author_id,
        ':abstract' => $abstract,
        ':keyword' => $keyword,
        ':references' => $reference,
        'comment' => $comment
    );


    database_run($sql, $params);
    Header("Location: timeline.php");
    exit();
} else {
    echo 'Error: Invalid request method.';
    exit();
}
?>
