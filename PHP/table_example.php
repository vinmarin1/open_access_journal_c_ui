<?php
require_once('dbcon.php');

// Fetch all articles
$query = "SELECT article_id, title FROM article WHERE author_id = 24";
$articles = database_run($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>Article List</title>
</head>
<body>

    <h1>Article List</h1>

    <ul>
        <?php foreach ($articles as $article): ?>
            <li><a href="table_function.php?id=<?= $article->article_id ?>"><?php echo $article->title ?></a></li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
