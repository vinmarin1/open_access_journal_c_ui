<?php
require_once 'dbcon.php'; 
deleteAllData();

function deleteAllData() {
    $pdo = connect_to_database();

    try {
        $query = "DELETE FROM `login_attempt`";

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $affectedRows = $stmt->rowCount();

        return $affectedRows;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    return false;
};
?>
