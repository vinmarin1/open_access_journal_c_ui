<?php
include 'dbcon.php';

    $month = $_GET['month'];
    $year = $_GET['year'];

    $sql = "SELECT `article_id`, `title`, `archive_date` FROM `article` WHERE `status` = 0 AND MONTH(`archive_date`) = ? AND YEAR(`archive_date`) = ?";

    $results = execute_query($sql, [$month, $year]);

    $data = array();
    if ($results !== false) {
        foreach ($results as $row) {
            // Limit the title to 100 characters
            $limitedTitle = strlen($row->title) > 150 ? substr($row->title, 0, 150) . '...' : $row->title;

            $data[] = array(
                'article_id' => $row->article_id,
                'title' => $limitedTitle,
                'archive_date' => $row->archive_date
            );
        }
    }

    echo json_encode(array('status' => true, 'data' => $data));
?>