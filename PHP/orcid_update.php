<?php
require_once 'dbcon.php';
session_start();

header('Content-Type: application/json');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orcid = $_POST['orcid'];
    $id = $_SESSION['id'];

    $sqlUpdateOrcid = "UPDATE author SET orc_id = :orc_id WHERE author_id = :author_id";
    $sqlparams = array('orc_id' => $orcid,
    'author_id' => $id);

    database_run($sqlUpdateOrcid, $sqlparams);
    

}


?>