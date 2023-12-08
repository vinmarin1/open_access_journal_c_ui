<?php
include 'dbcon.php';
    function get_user_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM author WHERE status = 1";
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

    function get_role_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM admin_role";
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
                $authorId = $_POST['author_id'];
            
                $result = execute_query("SELECT * FROM author WHERE author_id = ?", [$authorId]);
            
                header('Content-Type: application/json');
            
                if ($result !== false) {
                    echo json_encode(['status' => true, 'data' => $result]);
                } else {
                    echo json_encode(['status' => false, 'message' => 'Failed to fetch user data']);
                }
            }
            
    function addRecord()
    {
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $phone_number = $_POST['phone_number'];
        $school_name = $_POST['school_name'];
        $field_expertise = $_POST['field_expertise'];
        $orcid = $_POST['orcid'];
        $orcidurl = $_POST['orcidurl'];
        $status = 1;
    
        $query = "INSERT INTO author (first_name, middle_name, last_name, email, gender, birth_date, phone_number, school_name, field_of_expertise, `orc_id`, `url_orc_id`, `status`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $result = execute_query($query, [$first_name, $middle_name, $last_name, $email, $gender, $dob, $phone_number, $school_name, $field_expertise, $orcid, $orcidurl, $status
        ], true);
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add record']);
        }
    }
    
    function archiveUser()
    {
        $authorId = $_POST['author_id'];

        $query = "UPDATE author SET status = 0 WHERE author_id = ?";
        $result = execute_query($query, [$authorId]);
    
        echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'User archived successfully' : 'Failed to archive user']);
    }

    function updateUserData() {
        $authorId = $_POST['author_id'];
        $updatedData = $_POST['updated_data'];
    
        $query = "UPDATE author 
                    SET first_name = ?, middle_name = ?, last_name = ?, email = ?, 
                        phone_number = ?, gender = ?, birth_date = ?, orc_id = ?, 
                        url_orc_id = ?, school_name = ?, field_of_expertise = ? 
                    WHERE author_id = ?";
        
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);
        $check = $stm->execute([
            $updatedData['first_name'],
            $updatedData['middle_name'],
            $updatedData['last_name'],
            $updatedData['email'],
            $updatedData['phone_number'],
            $updatedData['gender'],
            $updatedData['dob'],
            $updatedData['orc_id'],
            $updatedData['url_orc_id'],
            $updatedData['school_name'],
            $updatedData['field_of_expertise'],
            $authorId
        ]);
    
        header('Content-Type: application/json');
    
        if ($check !== false) {
            echo json_encode(['status' => true, 'message' => 'User data updated successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update user data']);
        }
    }
    

?>
