<?php

include 'dbcon.php';

if (!function_exists('get_journal_list')) {
    function get_journal_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM journal";
                $stmt = $pdo->query($query);    

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