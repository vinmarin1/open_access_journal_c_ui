<?php
require_once 'dbcon.php'; // Include your database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Assuming you have sanitized and validated all inputs before this point
    $journalId = $_POST['journal_id']; // Retrieve the selected journal ID

    // Query the database to fetch subject areas based on the journal ID
    $sql = "SELECT subject_areas FROM journal WHERE journal_id = :journalId";
    $params = array('journalId' => $journalId);
    $result = database_run($sql, $params);

    if ($result) {
        $subjectAreas = $result[0]->subject_areas; // Assuming the query returns a single row
        // Split the subject areas into an array if needed
        $subjectAreasArray = explode(',', $subjectAreas);

        // Return the subject areas as JSON response
        header('Content-Type: application/json');
        echo json_encode(['subjectAreas' => $subjectAreasArray]);
        exit; // Stop further execution
    } else {
        // Handle case where no subject areas are found
        http_response_code(404);
        echo json_encode(['error' => 'Subject areas not found']);
        exit; // Stop further execution
    }
} else {
    // Handle invalid request method
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit; // Stop further execution
}
?>
