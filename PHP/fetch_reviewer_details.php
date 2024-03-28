<?php
require_once 'dbcon.php';

if (isset($_GET['reviewer_id']) && isset($_GET['article_id'])) {
    $authorId = $_GET['reviewer_id'];
    $articleId = $_GET['article_id'];
    
    $sql = "SELECT reviewer_questionnaire, comments 
    FROM reviewer_answer 
    WHERE author_id = :authorId 
    AND article_id = :article_id 
    AND (comments IS NOT NULL AND comments <> '')";

    $params = array(':authorId' => $authorId, ':article_id' => $articleId);
    
    $sqlRun = database_run($sql, $params);

    if ($sqlRun !== false) {
        // Prepare an array to hold the details
        $reviewerDetails = array();
        
        foreach ($sqlRun as $row) {
            $questionnaire = $row->reviewer_questionnaire;
            $comments = $row->comments;
            
            // Add the details to the array
            $reviewerDetails[] = array(
                'questionnaire' => $questionnaire,
                'comments' => $comments
            );
        }
        
        // Send the details as JSON response
        echo json_encode($reviewerDetails);
    } else {
        // Handle case when no data found
        echo json_encode(array('error' => 'No data found for the specified reviewer ID.'));
    }
} else {
    // Handle invalid request
    echo json_encode(array('error' => 'Invalid request'));
}
?>
