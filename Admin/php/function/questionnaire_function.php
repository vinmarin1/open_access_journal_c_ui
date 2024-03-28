<?php
require_once 'dbcon.php';

    if (!function_exists('get_answer_list')) {
        function get_answer_list()
        {
            $pdo = connect_to_database();

            if ($pdo) {
                try {
                    $query = "SELECT * FROM reviewer_questionnaire WHERE status = 1";
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
            fetchQuestionData();
            break;
        case 'add':
            addRecord();
            break;
        case 'update':
            updateQuestionData();
            break;
        case 'archive':
            archiveQuestion();
            break;
    }

    function fetchQuestionData() {
        $reviewer_questionnaire_id = $_POST['reviewer_questionnaire_id'];
    
        $result = execute_query("SELECT * FROM reviewer_questionnaire WHERE reviewer_questionnaire_id = ?", [$reviewer_questionnaire_id]);
    
        header('Content-Type: application/json');
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'data' => $result]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to question user data']);
        }
    }
    
    function addRecord() {
        $question_type = $_POST['question_type'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];
    
        $query = "INSERT INTO reviewer_questionnaire (question_type, question, answer) 
        VALUES (?, ?, ?)";
    
        $result = execute_query($query, [$question_type, $question, $answer], true);
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add record']);
        }
    }

    function updateQuestionData() {
        $reviewer_questionnaire_id = $_POST['reviewer_questionnaire_id'];
        $updatedData = $_POST['updated_data'];
    
        $query = "UPDATE reviewer_questionnaire 
                    SET question = ?, answer = ?
                    WHERE reviewer_questionnaire_id = ?";
        
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);   
        $check = $stm->execute([
            $updatedData['question'],
            $updatedData['answer'],
            $reviewer_questionnaire_id

        ]);
    
        header('Content-Type: application/json');
    
        if ($check !== false) {
            echo json_encode(['status' => true, 'message' => 'Question data updated successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update question data']);
        }
    }

    function archiveQuestion()
    {
        $reviewer_questionnaire_id = $_POST['reviewer_questionnaire_id'];

        $query = "UPDATE reviewer_questionnaire SET status = 0 WHERE reviewer_questionnaire_id = ?";
        $result = execute_query($query, [$reviewer_questionnaire_id]);
    
        echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'Question archived successfully' : 'Failed to archive question']);
    }
?>