<?php
include 'dbcon.php';

    $action = isset($_POST['action']) ? $_POST['action'] : '';

    switch ($action) {
        case 'updatereviewcheckedfile':
            updaterReviewCheckedFiles();
            break;
        case 'updatereviewuncheckedfile':
            updaterReviewUnCheckedFiles();
            break; 
        case 'updatecopyeditingcheckedfile':
            updateCopyeditingCheckedFiles();
            break;
        case 'updatecopyeditinguncheckedfile':
            updateCopyeditingUnCheckedFiles();
            break; 
        case 'updatesubmissionfile':
            updateSubmissionFiles();
            break; 
    }
    function updateSubmissionFiles() {
        $ftp_server = "win8044.site4now.net";
        $ftp_user = "monorbeta-001";
        $ftp_password = "spF528@HkQdHi2n";
    
        $submissionFileId = isset($_POST['submissionfileid']) ? $_POST['submissionfileid'] : '';
    
        $files = $_FILES['submissionfile'];
        $success = true;
        $errorMessage = '';
    
        $fileName = basename($files["name"]);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        $allowedFileTypes = array('doc', 'docx');
    
        if (!in_array($fileType, $allowedFileTypes)) {
            $success = false;
            $errorMessage .= "File $fileName - Invalid file type ($fileType); ";
        }
    
        $maxFileSize = 20 * 1024 * 1024;
    
        if ($files["size"] > $maxFileSize) {
            $success = false;
            $errorMessage .= "File $fileName - Size exceeds the maximum allowed size; ";
        }
    
        if ($success) {
            // FTP configuration
            $ftp_conn = ftp_connect($ftp_server);
    
            if (!$ftp_conn) {
                $errorMessage = 'Failed to connect to FTP server.';
                echo json_encode(['success' => false, 'message' => $errorMessage, 'submissionfileid' => $submissionFileId]);
                return;
            }
    
            $login_result = ftp_login($ftp_conn, $ftp_user, $ftp_password);
    
            if (!$login_result) {
                $errorMessage = 'FTP login failed. Check your credentials.';
                echo json_encode(['success' => false, 'message' => $errorMessage, 'submissionfileid' => $submissionFileId]);
                return;
            }
    
            ftp_pasv($ftp_conn, true);
    
            $remoteFilePath = "/site1/journaldata/submitted-article/" . $fileName;
    
            // Upload file directly to FTP server
            if (!ftp_put($ftp_conn, $remoteFilePath, $files["tmp_name"], FTP_BINARY)) {
                $ftpError = ftp_last_error($ftp_conn);
                $errorMessage = "Failed to upload file to FTP server. FTP Error: $ftpError";
                echo json_encode(['success' => false, 'message' => $errorMessage, 'submissionfileid' => $submissionFileId]);
                ftp_close($ftp_conn);
                return;
            }
    
            // Close FTP connection
            ftp_close($ftp_conn);
    
            // Update the database with the FTP file path
            updateSelectedSubmissionFiles($submissionFileId, $fileName, $remoteFilePath);
    
            // Respond with success
            echo json_encode(['success' => true, 'submissionfileid' => $submissionFileId]);
        } else {
            $errorMessage = 'File failed to upload. ' . $errorMessage;
            echo json_encode(['success' => false, 'message' => $errorMessage, 'submissionfileid' => $submissionFileId]);
        }
    }
    
    function updateSelectedSubmissionFiles($submissionFileId, $fileName) {
        
        $query = "UPDATE article_files 
                  SET file_name = :fileName
                  WHERE article_files_id = :submissionFileId";
    
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);
    
        $stm->bindParam(':submissionFileId', $submissionFileId, PDO::PARAM_INT);
        $stm->bindParam(':fileName', $fileName, PDO::PARAM_STR);
    
        $check = $stm->execute();
    
        header('Content-Type: application/json');
    
        if ($check !== false) {
            echo json_encode(['status' => true, 'message' => 'File updated successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update file', 'submissionfileid' => $submissionFileId, 'fileName' => $fileName]);
        }
        exit;
    }
    
    function updaterReviewCheckedFiles() {
        $articleFilesIds = $_POST['checkedData'];
        $status = 1;
        
        if (!is_array($articleFilesIds)) {
            $articleFilesIds = array($articleFilesIds);
        }

        $decodedIds = json_decode($articleFilesIds[0], true);
        $articleFilesIds = array_column($decodedIds, 'articleFilesId');

        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        foreach ($articleFilesIds as $key => $articleFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $articleFilesId;
            $placeholders[] = $paramName;
        }

        $placeholders = implode(',', $placeholders);

        $query = "UPDATE article_files
                SET review = :status
                WHERE article_files_id IN ($placeholders)";

        $pdo = connect_to_database();

        $pdo->beginTransaction();

        $stm = $pdo->prepare($query);

        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }

        $check = $stm->execute();

        if ($check !== false) {
            echo "Review Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file review data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
    
    function updaterReviewUnCheckedFiles() {
        $articleFilesIds = $_POST['uncheckedData'];
        $status = 0;
        
        if (!is_array($articleFilesIds)) {
            $articleFilesIds = array($articleFilesIds);
        }

        $decodedIds = json_decode($articleFilesIds[0], true);
        $articleFilesIds = array_column($decodedIds, 'articleFilesId');
        $placeholders = array();

        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        foreach ($articleFilesIds as $key => $articleFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $articleFilesId;
            $placeholders[] = $paramName;
        }

        $placeholders = implode(',', $placeholders);

        $query = "UPDATE article_files
                SET review = :status
                WHERE article_files_id IN ($placeholders)";

        $pdo = connect_to_database();

        $pdo->beginTransaction();

        $stm = $pdo->prepare($query);

        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }

        $check = $stm->execute();

        if ($check !== false) {
            echo "Review Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file review data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }

    function updateCopyeditingCheckedFiles() {
        $articleFilesIds = $_POST['checkedData'];
        $status = 1;
        
        if (!is_array($articleFilesIds)) {
            $articleFilesIds = array($articleFilesIds);
        }

        $decodedIds = json_decode($articleFilesIds[0], true);
        $articleFilesIds = array_column($decodedIds, 'articleFilesId');

        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        foreach ($articleFilesIds as $key => $articleFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $articleFilesId;
            $placeholders[] = $paramName;
        }

        $placeholders = implode(',', $placeholders);

        $query = "UPDATE article_files
                SET copyediting = :status
                WHERE article_files_id IN ($placeholders)";

        $pdo = connect_to_database();

        $pdo->beginTransaction();

        $stm = $pdo->prepare($query);

        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }

        $check = $stm->execute();

        if ($check !== false) {
            echo "Copyediting Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file copyediting data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
    
    function updateCopyeditingUnCheckedFiles() {
        $articleFilesIds = $_POST['uncheckedData'];
        $status = 0;
        
        if (!is_array($articleFilesIds)) {
            $articleFilesIds = array($articleFilesIds);
        }

        $decodedIds = json_decode($articleFilesIds[0], true);
        $articleFilesIds = array_column($decodedIds, 'articleFilesId');

        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        foreach ($articleFilesIds as $key => $articleFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $articleFilesId;
            $placeholders[] = $paramName;
        }

        $placeholders = implode(',', $placeholders);

        $query = "UPDATE article_files
                SET copyediting = :status
                WHERE article_files_id IN ($placeholders)";

        $pdo = connect_to_database();

        $pdo->beginTransaction();

        $stm = $pdo->prepare($query);

        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }

        $check = $stm->execute();

        if ($check !== false) {
            echo "Copyediting Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file copyediting data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
    
?>