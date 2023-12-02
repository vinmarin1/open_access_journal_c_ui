<?php

include 'dbcon.php';

// Check if the function is not already defined
if (!function_exists('get_user_list')) {
    function get_user_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM author";
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