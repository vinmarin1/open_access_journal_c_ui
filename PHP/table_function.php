<?php

include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $publicname = $_POST["publicname"];
    $orcid = $_POST["orcid"];
    $email = $_POST["email"];

    // Insert data into the database using the function from dbcon.php
    $sql = "INSERT INTO contributors (firstname, lastname, publicname, orcid, email) VALUES (?, ?, ?, ?, ?)";
    
    $params = array($firstname, $lastname, $publicname, $orcid, $email);
    
   
    $result = database_run($sql, $params, true);

    if ($result !== false) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data";
    }
}
?>
