<?php

include 'dbcon.php';

// Check if the function is not already defined

if (!function_exists('get_issues_list')) {
    function get_issues_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM issues";
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
     
                function fetchUserData()
                {
                    $issues_id = $_POST['issues_id'];
                
                    $result = execute_query("SELECT * FROM issues WHERE issues_id = ?", [$issues_id]);
                
                    header('Content-Type: application/json');
                
                    if ($result !== false) {
                        echo json_encode(['status' => true, 'data' => $result]);
                    } else {
                        echo json_encode(['status' => false, 'message' => 'Failed to fetch user data']);
                    }
                }
             
                function addRecord()
                {
                    $volume = $_POST['volume'];
                    $number = $_POST['number'];
                    $year = $_POST['year'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $url_path = $_POST['url_path'];
                
                    $cover_image = '';  // Default value
                
                    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === 0) {
                        $uploadDir = '../admin/announcement_images/';
                        $cover_image = $uploadDir . basename($_FILES['cover_image']['name']);
                
                        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image)) {
                            // Continue with updating the database
                            $query = "INSERT INTO issues (volume,number,year, title, description,  cover_image, url_path) 
                                         VALUES (?, ?, ?, ?, ?, ?,?)";
                
                            error_log("SQL Query: $query, Parameters: " . print_r([$volume, $number, $year, $title, $description, $cover_image, $url_path], true));
                
                            $result = execute_query($query, [$volume, $number, $year, $title, $description, $cover_image, $url_path]);
                
                            error_log("Result: " . print_r($result, true));
                
                            if ($result !== false) {
                                echo json_encode(['status' => true, 'message' => 'Record added successfully']);
                            } else {
                                echo json_encode(['status' => false, 'message' => 'Failed to add record']);
                            }
                        } else {
                            echo json_encode(['status' => false, 'message' => 'Failed to move uploaded file']);
                        }
                    } else {
                        // Handle the case where no file is uploaded
                        echo json_encode(['status' => false, 'message' => 'No file uploaded']);
                    }
                }

?>