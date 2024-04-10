
<?php
require_once 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $author_id = $_SESSION['id'];

    $sql = "SELECT COUNT(*) AS notification_count FROM `notification` WHERE author_id = :author_id AND admin = 0";
    $params = array(':author_id' => $author_id);
    $result = database_run($sql, $params);

    if ($result !== false && !empty($result)) {
        $count = $result[0]->notification_count;

        $response = array(
            'count' => $count
        );

        echo json_encode($response);
    } else {
        $response = array(
            'count' => 0
        );

        echo json_encode($response);
    }
} else {

    echo json_encode(array('error' => 'Invalid request method'));
}
?>