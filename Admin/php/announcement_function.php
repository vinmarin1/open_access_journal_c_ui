<?php

include 'dbcon.php';

// Check if the function is not already defined
if (!function_exists('get_announcement_list')) {
    function get_announcement_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM announcement";
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
                 $announcement_Id = $_POST['announcement_id'];

                 
             
                 $result = execute_query("SELECT * FROM announcement WHERE announcement_id = ?", [$announcement_Id]);
             
                 header('Content-Type: application/json');
             
                 if ($result !== false) {
                     echo json_encode(['status' => true, 'data' => $result]);
                 } else {
                     echo json_encode(['status' => false, 'message' => 'Failed to fetch user data']);
                 }
             }
             
    function addRecord()
     {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
         $announcement_type_id = $_POST['announcement_type_id'];
         $title = $_POST['title'];
         $announcement_description = $_POST['announcement_description'];
         $announcement = $_POST['announcement'];
         $upload_image = $_POST['upload_image'];
         $expired_date= $_POST['expired_date'];
         
        
     
         $query = "INSERT INTO announcement (announcement_type_id, title,announcement_description, announcement,upload_image ,expired_date) 
         VALUES (?, ?, ?, ?, ?)";
     
         $result = execute_query($query, [$announcement_type_id, $title, $announcement_description , $announcement,$upload_image, $expired_date ], true);
     
         if ($result !== false) {
             echo 'hello world';
         } else {
             echo json_encode(['status' => false, 'message' => 'Failed to add record']);
         }
     }
    }

?>

   
