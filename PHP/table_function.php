<?php
require_once('dbcon.php');

// Get the article ID from the URL parameter
$articleId = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch the details of the selected article
$query = "SELECT * FROM article WHERE article_id = ?";
$articleDetails = database_run($query, array($articleId));

if (!$articleDetails) {
    // Handle the case where the article is not found
    die("Article not found");
}

$article = $articleDetails[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Details</title>
</head>
<body>

    <h1>Article Details</h1>

    <h2><?php echo $article->title ?></h2>
    <p><strong>Author:</strong> <?php echo $article->author ?></p>
    <p><strong>Abstract:</strong> <?php echo $article->abstract ?></p>

</body>
</html>
