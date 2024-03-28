<?php
require_once 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming your form fields are arrays, handle them accordingly
    $coAuthors = isset($_POST['contributor_type_coauthor']) ? $_POST['contributor_type_coauthor'] : array();
    $primaryContacts = isset($_POST['contributor_type_primarycontact']) ? $_POST['contributor_type_primarycontact'] : array();
    $firstNames = $_POST['firstname'];
    $lastNames = $_POST['lastname'];
    $publicNames = $_POST['publicname'];
    $orcids = $_POST['orcid'];
    $emails = $_POST['email'];

    // Loop through the submitted data and insert into the database
    foreach ($firstNames as $key => $firstName) {
        $contributorType = array();
    
        // Check if Co-Author checkbox is selected for this contributor
        if (isset($coAuthors[$key]) && $coAuthors[$key] == 'Co-Author') {
            $contributorType[] = 'Co-Author';
        }
    
        // Check if Primary Contact checkbox is selected for this contributor
        if (isset($primaryContacts[$key]) && $primaryContacts[$key] == 'Primary Contact') {
            $contributorType[] = 'Primary Contact';
        }
    
        // Combine roles into a comma-separated string
        $contributorTypeString = implode(', ', $contributorType);

        $sqlCont = "INSERT INTO contributors (article_id, contributor_type, firstname, lastname, publicname, orcid, email) VALUES (:article_id, :contributor_type, :firstname, :lastname, :publicname, :orcid, :email)";    
        $paramsCont = array(
            'article_id' => 1,  // You may replace this with the appropriate article_id
            'contributor_type' => $contributorTypeString,
            'firstname' => $firstName,
            'lastname' => $lastNames[$key],
            'publicname' => $publicNames[$key],
            'orcid' => $orcids[$key],
            'email' => $emails[$key],
        );

        database_run($sqlCont, $paramsCont);
    }

    // Optionally, you can send a response back to the client
    echo json_encode(['success' => true]);
} else {
    // Handle non-POST requests accordingly
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
