<?php
require_once 'dbcon.php';

if (!function_exists('get_message_list')) {
    function get_message_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM message WHERE status = 1";
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
$action = isset($_POST['action']) ? $_POST['action'] : '';

        switch ($action) {
            case 'fetch':
                fetchMessageData();
                break;
            case 'update':
                updateMessageData();
                break;
            case 'archive':
                archiveMessage();
                break;
        }
        function fetchMessageData() {
            $message_id = $_POST['message_id'];
        
            $result = execute_query("SELECT * FROM message WHERE message_id = ?", [$message_id]);
        
            header('Content-Type: application/json');
        
            if ($result !== false) {
                echo json_encode(['status' => true, 'data' => $result]);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to fetch Message data']);
            }
        }
        function updateMessageData() {
            $message_id = $_POST['message_id'];
            $updatedData = $_POST['updated_data'];
        
            $query = "UPDATE message SET name = ?, email = ?, reason = ?, message = ? WHERE message_id = ?";
        
            $pdo = connect_to_database();
        
            $stm = $pdo->prepare($query);   
            $check = $stm->execute([
                $updatedData['name'],
                $updatedData['email'],
                $updatedData['reason'],
                $updatedData['message'],
                $message_id
            ]);
        
            header('Content-Type: application/json');
        
            if ($check !== false) {
                echo json_encode(['status' => true, 'message' => 'Message data updated successfully']);
            } else {
    
                $errorInfo = $stm->errorInfo();
                echo json_encode(['status' => false, 'message' => 'Failed to update Message data', 'error' => $errorInfo]);
            }
        }    
    
        function archiveMessage()
        {
            $message_id = $_POST['message_id'];
    
            $query = "UPDATE message SET status = 0 WHERE message_id = ?";
            $result = execute_query($query, [$message_id]);
        
            echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'Message archived successfully' : 'Failed to archive message']);
        }
?>