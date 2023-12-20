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
    $category = $_POST['journal-type']; 
    $comment = $_POST['notes'];
    $volume = "Volume 1";
    $dateString = "March 2023";
    $timestamp = strtotime($dateString);
    $formattedDate = date('Y-m-d', $timestamp);
    $content = "-";
    $step = 4;
 
    $author_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : null;
    $contributor = (isset($_SESSION['first_name'])) ? $_SESSION['first_name'] : null;

    if ($author_id === null && $contributor){
        echo 'Can\'t find information about this user.';
        exit();
    }

    // Check if file uploads are successful
    if (!empty($_FILES['file_name']['name'])) {
        $file_name = $_FILES['file_name']['name'];
        handleFileUpload($file_name, $contributor, $author_id, $volume, $privacy, $formattedDate, $title, $category, $abstract, $keywords, $reference, $comment, $step);
    }

    if (!empty($_FILES['file_name2']['name'])) {
        $file_name2 = $_FILES['file_name2']['name'];
        handleFileUpload($file_name2, $contributor, $author_id, $volume, $privacy, $formattedDate, $title, $category, $abstract, $keywords, $reference, $comment, $step);
    }

    if (!empty($_FILES['file_name3']['name'])) {
        $file_name3 = $_FILES['file_name3']['name'];
        handleFileUpload($file_name3, $contributor, $author_id, $volume, $privacy, $formattedDate, $title, $category, $abstract, $keywords, $reference, $comment, $step);
    }

    Header("Location: ex_submit.php");
    exit();
} else {
    echo 'Error: Invalid request method.';
    exit();
}

function handleFileUpload($file_name, $contributor, $author_id, $volume, $privacy, $formattedDate, $title, $category, $abstract, $keywords, $reference, $comment, $step) {
    global $lastInsertedArticleId;

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
        'keyword' => $keywords,
        'references' => $reference,
        'content' => "-",
        'status' => 4,
        'step' => $step,
        'comment' => $comment
    );

    $lastInsertedArticleId = database_run($sql, $params, true);

   
    $uploadDirectory = "../Files/submitted-article/"; 
    $targetFilePath = $uploadDirectory . $file_name;
    if (!empty($_FILES['file_name']['name'])) {
        $file_name = $_FILES['file_name']['name'];
        $targetFilePath2 = $uploadDirectory . $file_name;
        if (move_uploaded_file($_FILES['file_name']['tmp_name'], $targetFilePath2)) {
          
            $files_sql2 = "INSERT INTO example_files (article_id, file_name) VALUES (:article_id, :file_name)";
            $files_params2 = array(
                ':article_id' => $lastInsertedArticleId,
                ':file_name' => $file_name
            );
            
            
            database_run($files_sql2, $files_params2);
        } else {
            Header("Location: ex_submit.php");
            exit();
        }
    }
    
    

    if (!empty($_FILES['file_name2']['name'])) {
        $file_name2 = $_FILES['file_name2']['name'];
        $targetFilePath2 = $uploadDirectory . $file_name2;
        if (move_uploaded_file($_FILES['file_name2']['tmp_name'], $targetFilePath2)) {
          
            $files_sql2 = "INSERT INTO example_files (article_id, file_name) VALUES (:article_id, :file_name)";
            $files_params2 = array(
                ':article_id' => $lastInsertedArticleId,
                ':file_name' => $file_name2
            );
    
            database_run($files_sql2, $files_params2);
        } else {
            Header("Location: ex_submit.php");
            exit();
        }
    }
    

    if (!empty($_FILES['file_name3']['name'])) {
        $file_name3 = $_FILES['file_name3']['name'];
        $targetFilePath3 = $uploadDirectory . $file_name3;
        if (move_uploaded_file($_FILES['file_name3']['tmp_name'], $targetFilePath3)) {
          
            $files_sql3 = "INSERT INTO example_files (article_id, file_name) VALUES (:article_id, :file_name)";
            $files_params3 = array(
                ':article_id' => $lastInsertedArticleId,
                ':file_name' => $file_name3
            );
    
            database_run($files_sql3, $files_params3);
        } else {
            Header("Location: ex_submit.php");
            exit();
        }
    }
}
?>
