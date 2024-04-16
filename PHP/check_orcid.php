<?php
require 'dbcon.php';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['orcid']) && !empty($_POST['orcid']) && isset($_POST['author_id'])) {
    $orc_id = $_POST['orcid'];
    $author_id = $_POST['author_id'];

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

            $sqlSelectName = "SELECT first_name, last_name FROM author WHERE author_id = :author_id";

            $result = database_run($sqlSelectName, array(':author_id' => $author_id));

            if ($result) {
                if (count($result) > 0) {
                    $user = $result[0];
                    $db_first_name = $user->first_name;
                    $db_last_name = $user->last_name;

                    if (strtolower(trim($givenName)) !== strtolower(trim($db_first_name)) || 
                    strtolower(trim($familyName)) !== strtolower(trim($db_last_name))) {
                    echo json_encode(['success' => false, 'message' => 'Credentials provided do not match the ORCID data.']);
                    } else {
                        echo json_encode(['success' => true, 'message' => 'Credentials provided match the ORCID data.']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'User not found.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Unable to fetch user info.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No data found for the provided ORCID. Please check the ORCID and try again.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
