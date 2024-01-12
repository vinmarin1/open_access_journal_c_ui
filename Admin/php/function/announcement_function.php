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
                        $announcement_id = $_POST['announcement_id'];

                        
                    
                        $result = execute_query("SELECT * FROM announcement WHERE announcement_id = ?", [$announcement_id]);
                    
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
        $announcement_type_id = $_POST['announcement_type_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $announcement = $_POST['announcement'];
        $expired_date = $_POST['expired_date'];
        $status = 1;
    
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $uploadPath = $documentRoot . '/Files/announcement-image/';

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $imageFile = $_FILES['upload_image'];
        $imageName = basename($imageFile["name"]);
        $upload_image = '';

        if (isset($_FILES['upload_image']) && $_FILES['upload_image']['error'] === UPLOAD_ERR_OK) {
            $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $allowedFileTypes = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($imageFileType, $allowedFileTypes)) {
                $upload_image = $uploadPath . $imageName;
                if (!move_uploaded_file($imageFile["tmp_name"], $upload_image)) {
                    throw new Exception('Failed to move uploaded file.');
                }
            } else {
                throw new Exception('Invalid file type.');
            }
        } else {
            // Log the file upload error
            throw new Exception('File upload error: ' . $_FILES['upload_image']['error']);
        }

        $query = "INSERT INTO announcement (announcement_type_id, title, description, announcement,status, upload_image, expired_date) 
                  VALUES (?, ?, ?, ?, ?, ?,?)";

        $result = execute_query($query, [$announcement_type_id, $title, $description, $announcement,$status, $upload_image, $expired_date]);

        if ($result !== false) {
            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
        } else {
            // Log the database error
            throw new Exception('Failed to add record: ' . $result->errorInfo()[2]);
        }
    } catch (Exception $e) {
        // If an exception occurs, log the exception message
        echo json_encode(['status' => false, 'message' => $e->getMessage()]);
    }
}
                    


                    if (!function_exists('get_announcementtype_list')) {
                        function get_announcementtype_list()
                        {
                            $pdo = connect_to_database();
                    
                            if ($pdo) {
                                try {
                                    $query = "SELECT announcement_type_id, announcement_type FROM announcement_type";
                                    $stmt = $pdo->query($query);
                    
                                    // Fetch the data as an associative array
                                    $announcementTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                                    return $announcementTypes;
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                    return false;
                                }
                            }
                    
                            return false;
                        }
                    }

    ?>

        
