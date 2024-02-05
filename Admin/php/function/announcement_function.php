<?php
include 'dbcon.php';

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
        }
    
        $query = "INSERT INTO announcement (title, announcement_description, announcement, upload_image, expired_date) 
                  VALUES (?, ?, ?, ?, ?)";
    
    $result = execute_query($query, [$title, $announcement_description, $announcement, $imageName, $expired_date]);
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
        } else {
            throw new Exception('Failed to add record');
        }
    } catch (Exception $e) {
        // If an exception occurs
        echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        // Log the error to a file or error reporting system
        error_log($e->getMessage(), 0);
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

function archiveAnnouncement() {
    $announcement_id = $_POST['announcement_id'];

    $query = "UPDATE announcement SET status = 0 WHERE announcement_id = ?";
    $result = execute_query($query, [$announcement_id]);

    echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'Announcement archived successfully' : 'Failed to archive announcement']);
}


?>

    
