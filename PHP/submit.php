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
    $privacy = $_POST['privacy'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $keyword = $_POST['keyword'];
    $reference = $_POST['reference'];
    $category = $_POST['category']; 
    $comment = $_POST['notes'];
    $file_name = $_POST['file_name'];
    $volume = "Volume 1";
    $dateString = "March 2023";
    $timestamp = strtotime($dateString);
    $formattedDate = date('Y-m-d', $timestamp);
    $content = "-";
    $step = 4;

// Now $formattedDate contains the date in 'YYYY-MM-DD' format

  
    
    $author_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : null;
    $contributor = (isset($_SESSION['first_name'])) ? $_SESSION['first_name'] : null;

    if ($author_id === null && $contributor){
        echo 'Can\'t find information about this user.';
        exit();
    }

   // Insert into article table
   $sql = "INSERT INTO article (`author`, `volume`, `privacy`, `date`, `title`, `journal_id`, `author_id`, `abstract`, `keyword`, `references`, `content`, `status`, `step`, `comment`)
   VALUES (:author, :volume, :privacy, :date, :title, :journal_id, :author_id, :abstract, :keyword, :references, :content, :status, :step, :comment)";
   
$params = array(
'author' => $contributor,
'volume' => $volume,
'privacy' => $privacy,
'date' => $formattedDate,
'title' => $title,
'journal_id' => $category,
'author_id' => $author_id,
'abstract' => $abstract,
'keyword' => $keyword,
'references' => $reference,
'content' => "-",
'status' => 4,
'step' => $step,
'comment' => $comment
);

// Use the modified function with $isInsert set to true
$lastInsertedArticleId = database_run($sql, $params, true);

// Insert into example_files table with the retrieved article_id
$files_sql = "INSERT INTO example_files (article_id, file_name) VALUES (:article_id, :file_name)";
$files_params = array(
':article_id' => $lastInsertedArticleId,
':file_name' => $file_name
);

database_run($files_sql, $files_params);


    Header("Location: timeline.php");
    exit();
} else {
    echo 'Error: Invalid request method.';
    exit();
}
?>