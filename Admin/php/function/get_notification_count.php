<?php
include 'dbcon.php';

if (!function_exists('get_notification_data')) {
    function get_notification_data()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                // Select all fields from the notification table, ordered by ID
                $query = "SELECT * FROM notification WHERE admin = 1 ORDER BY id DESC";
                $stmt = $pdo->prepare($query);
                $stmt->execute();

                // Fetch all notification data
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $count = count($data);

                return array(
                    'count' => $count,
                    'data' => $data
                );
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        } else {
            echo "Error: Database connection failed.";
            return false;
        }
    }
}

$notification_data = get_notification_data();

echo json_encode($notification_data);

?>
