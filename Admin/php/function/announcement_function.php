        <?php

        include 'dbcon.php';

        // Check if the function is not already defined
        if (!function_exists('get_announcement_list')) {
            function get_announcement_list()
            {
                $pdo = connect_to_database();

                if ($pdo) {
                    try {
                        $query = "SELECT * FROM announcement WHERE status = 1";
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
                    archiveAnnouncement();
                    break;
                case 'fetch':
                    fetchUserData();
                    break;
                case 'update':
                    updateAnnouncementData();
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
        $title = $_POST['title'];
        $announcement_description = $_POST['announcement_description'];
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
        $upload_image =$imageName;

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

        $query = "INSERT INTO announcement ( title, announcement_description, announcement,status, upload_image, expired_date) 
                  VALUES ( ?, ?, ?, ?, ?, ?)";

        $result = execute_query($query, [$title, $announcement_description, $announcement,$status,  $upload_image, $expired_date]);

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
                    
function updateAnnouncementData() {
    try {
        $announcement_id = $_POST['announcement_id'];
        $updatedData = $_POST['updated_data'];
    
        $query = "UPDATE announcement 
                    SET title = ?, announcement_description = ?, announcement = ? 
                    WHERE announcement_id = ?";
        
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);
        $check = $stm->execute([
            $updatedData['title'],
            $updatedData['announcement_description'],
            $updatedData['announcement'],
            $announcement_id
        ]);
    
        header('Content-Type: application/json');
    
        if ($check !== false) {
            echo json_encode(['status' => true, 'message' => 'Announcement data updated successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update Announcement data']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function archiveAnnouncement()
{
    $announcement_id = $_POST['announcement_id'];

    $query = "UPDATE announcement SET status = 0 WHERE announcement_id = ?";
    $result = execute_query($query, [$announcement_id]);

    echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'Announcement archived successfully' : 'Failed to archive announcement']);
}


    ?>

        
