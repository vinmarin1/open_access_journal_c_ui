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
                        $announcement_type_id = $_POST['announcement_type_id'];
                        $title = $_POST['title'];
                        $announcement_description = $_POST['announcement_description'];
                        $announcement = $_POST['announcement'];
                        $expired_date = $_POST['expired_date'];
                    
                        // File handling
                        $upload_image = '';  // Default value
                        if (isset($_FILES['upload_image']) && $_FILES['upload_image']['error'] === 0) {
                            $uploadDir = 'admin/announcement_images/';  // Updated path to your desired upload directory
                            $upload_image = $uploadDir . basename($_FILES['upload_image']['name']);
                            move_uploaded_file($_FILES['upload_image']['tmp_name'], $upload_image);
                        }
                    
                        $query = "INSERT INTO announcement (announcement_type_id, title, announcement_description, announcement, upload_image, expired_date) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                    
                        // Debugging - log SQL query and parameters
                        error_log("SQL Query: $query, Parameters: " . print_r([$announcement_type_id, $title, $announcement_description, $announcement, $upload_image, $expired_date], true));
                    
                        $result = execute_query($query, [$announcement_type_id, $title, $announcement_description, $announcement, $upload_image, $expired_date]);
                    
                        // Debugging - log the result
                        error_log("Result: " . print_r($result, true));
                     
                        if ($result !== false) {
                            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
                        } else {
                            echo json_encode(['status' => false, 'message' => 'Failed to add record']);
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

        
