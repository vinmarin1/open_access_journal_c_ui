<?php
require 'dbcon.php';

header('Content-Type: application/json');

function checkOrcid($data) {
    $errors = array();

    $checkOrcid = database_run("SELECT * FROM author WHERE orc_id = :orc_id LIMIT 1", ['orc_id' => $data['orcid']]);
    
    if (!empty($checkOrcid)) {
        $errors[] = "The ORCID already exists";
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orcid = $_POST['orcid'];

    $orcidErrors = checkOrcid($_POST);

    if (!empty($orcidErrors)) {
        echo json_encode(['success' => false, 'message' => implode(', ', $orcidErrors)]);
    }else{
        echo json_encode(['success' => true, 'message' => 'Update Success']);
    }

}


?>