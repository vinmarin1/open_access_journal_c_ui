<?php
include 'dbcon.php';

header('Content-Type: application/json');

$month = $_GET['month'];
$year = $_GET['year'];

$sql = "SELECT `article_id`, `title`, `publication_date` FROM `article` WHERE `status` = 1 AND MONTH(`publication_date`) = ? AND YEAR(`publication_date`) = ?";

// Assume execute_query handles prepared statements
$results = execute_query($sql, [$month, $year]);

$data = array();

if ($results !== false) {
    foreach ($results as $row) {
        // Limit the title to 150 characters
        $limitedTitle = strlen($row->title) > 150 ? substr($row->title, 0, 150) . '...' : $row->title;

        $data[] = array(
            'article_id' => $row->article_id,
            'title' => $limitedTitle,
            'publication_date' => $row->publication_date
        );
    }

    echo json_encode(array('status' => true, 'data' => $data));
} else {
    // Provide an empty data array if there are no results
    echo json_encode(array('status' => true, 'data' => []));
}
?>
