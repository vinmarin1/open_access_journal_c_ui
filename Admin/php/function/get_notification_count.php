<?php
include 'dbcon.php';

if (!function_exists('get_notification_count')) {
    function get_notification_count()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT COUNT(id) AS notification_count FROM notification";
                $stmt = $pdo->prepare($query);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                return $result['notification_count']; // Return only the count value
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        return false;
    }
}

$notification_count = get_notification_count();

echo $notification_count;
