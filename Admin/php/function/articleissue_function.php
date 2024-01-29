<?php
include 'dbcon.php';

// Check if the function is not already defined
if (!function_exists('get_article_list')) {
    function get_article_list($issid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article WHERE issues_id = :issid AND status = 11";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':issid', $issid, PDO::PARAM_INT);
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

?>