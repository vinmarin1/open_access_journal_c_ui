<?php
require_once 'dbcon.php';

if (!function_exists('get_notification_data')) {
    function get_notification_data()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                // Count query
                $countQuery = "SELECT COUNT(*) as count FROM notification WHERE admin = 1 AND `read` = 1";
                $countStmt = $pdo->prepare($countQuery);
                $countStmt->execute();
                $countResult = $countStmt->fetch(PDO::FETCH_ASSOC);
                $count = $countResult['count'];

                // Data query
                $dataQuery = "SELECT * FROM notification WHERE admin = 1 ORDER BY id DESC";
                $stmt = $pdo->prepare($dataQuery);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
