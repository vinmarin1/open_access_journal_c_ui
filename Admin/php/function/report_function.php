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
?>