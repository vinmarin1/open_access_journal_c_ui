<?php
include 'dbcon.php';

if (!function_exists('get_report_list')) {
    function get_report_list() {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM reports";
                $stmt = $pdo->prepare($query);
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                return $result;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        return false;
    }
}

if (!function_exists('get_archive_article_list')) {
    function get_archive_article_list($month, $year) {
        $month = $_GET["m"] ?? date('m');
        $year = $_GET["y"] ?? date('Y');

        $sql = "SELECT `article_id`, `title`, `archive_date` FROM `article` WHERE `status` = 0 AND MONTH(`archive_date`) = ? AND YEAR(`archive_date`) = ?";

        $results = execute_query($sql, [$month, $year]);

        $data = array();

        if ($results !== false) {
            $data['articlelist'] = $results;
            return $data;
        } else {
            return array('status' => true, 'data' => []);
        }
    }
}

if (!function_exists('get_published_article_list')) {
    function get_published_article_list($month, $year) {
        $month = $_GET["m"] ?? date('m');
        $year = $_GET["y"] ?? date('Y');

        $sql = "SELECT `article_id`, `title`, `publication_date` FROM `article` WHERE `status` = 1 AND MONTH(`publication_date`) = ? AND YEAR(`publication_date`) = ?";

        $results = execute_query($sql, [$month, $year]);

        $data = array();

        if ($results !== false) {
            $data['articlelist'] = $results;
            return $data;
        } else {
            return array('status' => true, 'data' => []);
        }
    }
}
?>