<?php

require_once 'dbcon.php';


$email = isset($_POST['email']) ? $_POST['email'] : '';


$query = "SELECT first_name, last_name, orc_id FROM author WHERE email = :email";
$params = array(':email' => $email);


$authorData = database_run($query, $params);

if ($authorData) {
 
    $response = array('success' => true, 'data' => $authorData[0]); 
} else {
  
    $response = array('success' => false);
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
