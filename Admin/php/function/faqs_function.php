<?php
include 'dbcon.php';

if (!function_exists('get_faqs_list')) {
    function get_faqs_list()
    {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM faqs WHERE status = 1";
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
            case 'fetch':
                fetchFaqsData();
                break;
            case 'add':
                addRecord();
                break;
            case 'update':
                updateFaqsData();
                break;
            case 'archive':
                archiveFaqs();
                break;
        }
    
    function fetchFaqsData() {
        $id = $_POST['id'];
    
        $result = execute_query("SELECT * FROM faqs WHERE id = ?", [$id]);
    
        header('Content-Type: application/json');
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'data' => $result]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to fetch Faqs data']);
        }
    }

    function addRecord() {
            $question = $_POST['question'];
            $answer = $_POST['answer'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $link = $_POST['link'];
            $status = 1;
    
            $query = "INSERT INTO faqs (question, answer, category, description, link, status) 
        VALUES (?, ?, ?, ?, ?, ?)";
    
        $result = execute_query($query, [$question, $answer, $category, $description, $link, $status], true);
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add record']);
        }
    }
    
    function updateFaqsData() {
        $id = $_POST['id'];
        $updatedData = $_POST['updated_data'];
    
        $query = "UPDATE faqs SET question = ?, answer = ?, category = ?, description = ?, link = ? WHERE id = ?";
    
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);   
        $check = $stm->execute([
            $updatedData['question'],
            $updatedData['answer'],
            $updatedData['category'],
            $updatedData['description'],
            $updatedData['link'],
            $id
        ]);
    
        header('Content-Type: application/json');
    
        if ($check !== false) {
            echo json_encode(['status' => true, 'message' => 'FAQs data updated successfully']);
        } else {

            $errorInfo = $stm->errorInfo();
            echo json_encode(['status' => false, 'message' => 'Failed to update FAQs data', 'error' => $errorInfo]);
        }
    }    

    function archiveFaqs()
    {
        $id = $_POST['id'];

        $query = "UPDATE faqs SET status = 0 WHERE id = ?";
        $result = execute_query($query, [$id]);
    
        echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'Faqs archived successfully' : 'Failed to archive faqs']);
    }
?>