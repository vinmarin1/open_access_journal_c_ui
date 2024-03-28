<?php
require_once 'dbcon.php';

function update_notification() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Assuming you're sending the notification ID via POST
        $id = $_POST['id'];
        
        // Update query
        $query = "UPDATE notification SET `read` = 0 WHERE id = :id";
        
        $pdo = connect_to_database();
        
        if ($pdo) {
            try {
                $stm = $pdo->prepare($query);
                $stm->bindParam(':id', $id, PDO::PARAM_INT);
                $check = $stm->execute();
                
                header('Content-Type: application/json');
                
                if ($check !== false) {
                    echo json_encode(['status' => true, 'message' => 'Notification updated successfully!']);
                } else {
                    echo json_encode(['status' => false, 'message' => 'Failed to update notification']);
                }
                exit;
            } catch (PDOException $e) {
                echo json_encode(['status' => false, 'message' => 'Database error: ' . $e->getMessage()]);
                exit;
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Database connection failed']);
            exit;
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Invalid request method']);
        exit;
    }
}


update_notification();
?>