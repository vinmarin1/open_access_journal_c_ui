<?php
require_once 'dbcon.php';
session_start();
$author_id = $_SESSION['id'];

if (!function_exists('get_notification_data')) {
    function get_notification_data()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                // Count query
                $countQuery = "SELECT COUNT(*) as count FROM notification WHERE admin = 0 AND `read` = 0 AND author_id = $author_id";
                $countStmt = $pdo->prepare($countQuery);
                $countStmt->execute();
                $countResult = $countStmt->fetch(PDO::FETCH_ASSOC);
                $count = $countResult['count'];

                return array('count' => $count);
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
