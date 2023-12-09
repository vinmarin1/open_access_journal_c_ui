<?php

include 'dbcon.php';

// Check if the function is not already defined

if (!function_exists('get_announcementtype_list')) {
    function get_announcementtype_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM announcement_type";
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

     // Check if the 'action' index is set
     $action = isset($_POST['action']) ? $_POST['action'] : '';

     switch ($action) {
         case 'add':
             addRecord();
             break;
         case 'archive':
             archiveUser();
             break;
         case 'fetch':
             fetchUserData();
             break;
         case 'update':
             updateUserData();
             break;
     }
     
             function fetchUserData() {
                 $announcement_type_Id = $_POST['announcement_type_id'];
             
                 $result = execute_query("SELECT * FROM announcement_type WHERE announcement__type_id = ?", [$announcement_type_Id]);
             
                 header('Content-Type: application/json');
             
                 if ($result !== false) {
                     echo json_encode(['status' => true, 'data' => $result]);
                 } else {
                     echo json_encode(['status' => false, 'message' => 'Failed to fetch user data']);
                 }
             }
             
     function addRecord()
     {
         $announcement_type = $_POST['announcement_type'];
        
     
         $query = "INSERT INTO announcement_type (announcement_type) 
         VALUES (?)";
       
         $result = execute_query($query, [$announcement_type ], true);
     
         if ($result !== false) {
             echo json_encode(['status' => true, 'message' => 'Record added successfully']);
         } else {
             echo json_encode(['status' => false, 'message' => 'Failed to add record']);
         }
     }

     function updateUserData() {
        $announcement_type_Id = $_POST['announcement_type_id'];
        $updatedData = $_POST['updated_data'];
    
        $query = "UPDATE announcement_type 
                    SET announcment_type = ?
                    WHERE announcement_type_id = ?";
        
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);
        $check = $stm->execute([
            $updatedData['announcement_type'],
            $announcement_type_Id
        ]);
    
        header('Content-Type: application/json');
    
        if ($check !== false) {
            echo json_encode(['status' => true, 'message' => 'User data updated successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update user data']);
        }
    }
    

?>