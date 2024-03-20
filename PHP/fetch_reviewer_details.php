<?php
require 'dbcon.php';
if (isset($_GET['author_id'])) {
    $authorId = $_GET['author_id'];
    
    $sql = "SELECT reviewer_questionnaire, comments FROM reviewer_answer WHERE author_id = :authorId";
    echo "<p>Questionnaire: $questionnaire</p>";
    echo "<p>Comments: $comments</p>";
} else {
    echo "Invalid request";
}
?>
