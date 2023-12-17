<?php
include 'dbcon.php';

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

    $action = isset($_POST['action']) ? $_POST['action'] : '';

        switch ($action) {
            case 'fetch':
                fetchJournalData();
                break;
            case 'add':
                addRecord();
                break;
            case 'update':
                updateJournalData();
                break;
            case 'archive':
                archiveJournal();
                break;
        }
    
    function fetchJournalData() {
        $journalId = $_POST['journal_id'];
    
        $result = execute_query("SELECT * FROM journal WHERE journal_id = ?", [$journalId]);
    
        header('Content-Type: application/json');
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'data' => $result]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to fetch user data']);
        }
    }

    function addRecord()
    {
        $journal = $_POST['journal'];
        $journal_title= $_POST['journal_title'];
        $editorial = $_POST['editorial'];
        $description = $_POST['description'];
        $status = 1;

        $query = "INSERT INTO journal (journal, journal_title, editorial, description, status) 
        VALUES (?, ?, ?, ?, ?)";
    
        $result = execute_query($query, [$journal, $journal_title, $editorial, $description, $status], true);
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add record']);
        }
    }

    function updateJournalData() {
        $journalId = $_POST['journal_id'];
        $updatedData = $_POST['updated_data'];
    
        $query = "UPDATE journal 
                    SET journal = ?, journal_title = ?, editorial = ?, description = ?
                    WHERE journal_id = ?";
        
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);   
        $check = $stm->execute([
            $updatedData['journal'],
            $updatedData['journal_title'],
            $updatedData['editorial'],
            $updatedData['description'],
            $journalId

        ]);
    
        header('Content-Type: application/json');
    
        if ($check !== false) {
            echo json_encode(['status' => true, 'message' => 'Journal data updated successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update journal data']);
        }
    }

    function archiveJournal()
    {
        $journalId = $_POST['journal_id'];

        $query = "UPDATE journal SET status = 0 WHERE journal_id = ?";
        $result = execute_query($query, [$journalId]);
    
        echo json_encode(['status' => $result !== false, 'message' => $result !== false ? 'Journal archived successfully' : 'Failed to archive journal']);
    }

?>