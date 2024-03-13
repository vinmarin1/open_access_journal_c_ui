<?php

include 'dbcon.php';

// Check if the function is not already defined
if (!function_exists('get_article_list')) {
    function get_article_list($issid) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM article WHERE issues_id = :issid AND status = 11";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':issid', $issid, PDO::PARAM_INT);
                $stmt->execute();

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

if (!function_exists('get_journal_list')) {
    function get_journal_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM journal WHERE status = 1";
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

if (!function_exists('get_issues_list')) {
    function get_issues_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM issues WHERE status = 1";
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
             archiveIssue();
             break;
         case 'fetch':
             fetchIssueData();
             break;
         case 'update':
             updateIssueData();
             break;
     }
     
                function fetchIssueData()
                {
                    $id = $_POST['id'];
                
                    $result = execute_query("SELECT * FROM issues WHERE issues_id = ?", [$id]);
                
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
                        $issn = $_POST['issn'];
                        $volume = $_POST['volume'];
                        $number = $_POST['number'];
                        $year = $_POST['year'];
                        $title = $_POST['title'];
                        $journal_id = $_POST['journal_id'];
                        $status = 1;
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
                    
                        $query = "INSERT INTO issues (issn, volume, number, journal_id, year, title,  status , cover_image) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                
                        $result = execute_query($query, [$issn,  $volume, $number, $journal_id, $year, $title,  $status, $imageName], true);
                
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
        
                function updateIssueData() {
                    try {
                        $id = $_POST['id'];
                        $updatedData = $_POST['updated_data'];
                    
                        $query = "UPDATE issues 
                                    SET issn = ?,  volume = ?, number = ?, year = ?, title = ?
                                    WHERE issues_id = ?";
                        
                        $pdo = connect_to_database();
                    
                        $stm = $pdo->prepare($query);
                        $check = $stm->execute([
                            $updatedData['issn'],
                            $updatedData['volume'],
                            $updatedData['number'],
                            $updatedData['year'],
                            $updatedData['title'],
                            $id
                        ]);
                    
                        header('Content-Type: application/json');
                    
                        if ($check !== false) {
                            echo json_encode(['status' => true, 'message' => 'Issues data updated successfully']);
                        } else {
                            echo json_encode(['status' => false, 'message' => 'Failed to update issues data']);
                        }
                    } catch (PDOException $e) {
                        echo json_encode(['status' => false, 'message' => 'Database error: ' . $e->getMessage()]);
                    }
                }
            
                function archiveIssue()
                {
                    $id = $_POST['id'];
            
                    $query = "UPDATE issues  SET status = 0 WHERE issues_id = ?";
                    $result = execute_query($query, [$id]);
                
                    echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'Issues archived successfully' : 'Failed to archive issue']);
                }
            
                
?>