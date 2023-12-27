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
                    try {
                        $volume = $_POST['volume'];
                        $number = $_POST['number'];
                        $year = $_POST['year'];
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $url_path = $_POST['url_path'];
                
                        $uploadPath = "../../../Files/cover-image/";
                
                        if (!file_exists($uploadPath)) {
                            mkdir($uploadPath, 0777, true);
                        }
                
                        $imageFile = $_FILES['cover_image'];
                        $imageName = basename($imageFile["name"]);
                        $cover_image = '';
                
                        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
                            $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
                            $allowedFileTypes = array('jpg', 'jpeg', 'png', 'gif');
                
                            if (in_array($imageFileType, $allowedFileTypes)) {
                                $cover_image = $uploadPath . $imageName;
                                if (!move_uploaded_file($imageFile["tmp_name"], $cover_image)) {
                                    throw new Exception('Failed to move uploaded file.');
                                }
                            } else {
                                throw new Exception('Invalid file type.');
                            }
                        }
                
                        $query = "INSERT INTO issues (volume, number, year, title, description, cover_image, url_path) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?)";
                
                        $result = execute_query($query, [$volume, $number, $year, $title, $description, $cover_image, $url_path]);
                
                        if ($result !== false) {
                            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
                        } else {
                            echo json_encode(['status' => false, 'message' => 'Failed to add record']);
                        }
                    } catch (Exception $e) {
                        // If an exception occurs
                        echo json_encode(['status' => false, 'message' => $e->getMessage()]);
                    }
                }
                
        
            
                
?>