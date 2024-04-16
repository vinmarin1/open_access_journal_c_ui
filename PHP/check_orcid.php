<?php
require 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['orcid']) && !empty($_POST['orcid']) && isset($_POST['author_id']) && isset($_POST['firstName']) && isset($_POST['lastName'])) {
    $orc_id = $_POST['orcid'];
    $author_id = $_POST['author_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    $url = 'https://pub.orcid.org/v3.0/' . $orc_id;

    $options = [
        'http' => [
            'header' => "Accept: application/json\r\n",
        ],
    ];

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
        echo json_encode(['success' => false, 'message' => 'No data found for the provided ORCID. Please check the ORCID and try again.']);
    } else {
        $data = json_decode($response, true);

        if (isset($data['person'])) {
            $givenName = $data['person']['name']['given-names']['value'] ?? null;
            $familyName = $data['person']['name']['family-name']['value'] ?? null;
            
            if (strtolower(trim($givenName)) !== strtolower(trim($firstName)) || strtolower(trim($familyName)) !== strtolower(trim($lastName))) {
                echo json_encode(['success' => false, 'message' => 'Credentials provided do not match the ORCID data.']);
            } else {
                echo json_encode(['success' => true, 'message' => 'Credentials provided match the ORCID data.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No data found for the provided ORCID. Please check the ORCID and try again.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
