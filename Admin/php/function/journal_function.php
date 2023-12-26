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

    function addRecord() {
        $ftp_server = "win8044.site4now.net";
        $ftp_user = "monorbeta-001";
        $ftp_password = "spF528@HkQdHi2n";
        
        try {
            $journal = $_POST['journal'];
            $journal_title = $_POST['journal_title'];
            $editorial = $_POST['editorial'];
            $description = $_POST['description'];
            $status = 1;
    
            $ftp_conn = ftp_connect($ftp_server);
    
            if (!$ftp_conn) {
                throw new Exception('Failed to connect to FTP server.');
            }
    
            $login_result = ftp_login($ftp_conn, $ftp_user, $ftp_password);
    
            if (!$login_result) {
                throw new Exception('FTP login failed. Check your credentials.');
            }
    
            ftp_pasv($ftp_conn, true);

            $remoteDirectory = '/site1/journaldata/journalimage/';
            if (!ftp_chdir($ftp_conn, $remoteDirectory)) {
                ftp_mkdir($ftp_conn, $remoteDirectory);
                ftp_chdir($ftp_conn, $remoteDirectory);
            }
  
            $imageFile = $_FILES['journalimage'];
            $imageName = basename($imageFile["name"]);
            $localFilePath = $imageFile["tmp_name"];
    
            if ($imageFile['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('File upload failed. Check if the file was properly uploaded.');
            }
    
            $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $allowedFileTypes = array('jpg', 'jpeg', 'png', 'gif');
    
            if (!in_array($imageFileType, $allowedFileTypes)) {
                throw new Exception('Invalid file type.');
            }
    
            if (!ftp_put($ftp_conn, $imageName, $localFilePath, FTP_BINARY)) {
                $ftpError = ftp_last_error($ftp_conn);
                throw new Exception("Failed to upload file to FTP server. FTP Error: $ftpError");
            }
            
            ftp_close($ftp_conn);
    
            $query = "INSERT INTO journal (journal, journal_title, editorial, description, status, image) 
                VALUES (?, ?, ?, ?, ?, ?)";
    
            $result = execute_query($query, [$journal, $journal_title, $editorial, $description, $status, $imageName], true);
    
            if ($result !== false) {
                echo json_encode(['status' => true, 'message' => 'Record added successfully']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to add record']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
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