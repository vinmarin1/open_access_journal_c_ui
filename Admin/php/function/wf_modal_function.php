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
        case 'updatesubmissionfile':
            updateSubmissionFiles();
            break; 
    }

    function updateSubmissionFiles() {
        error_reporting(E_ALL);
    ini_set('display_errors', 1);

        $uploadPath = "../../../Files/submitted-article/";
        $submissionFileId = isset($_POST['submissionfileid']) ? $_POST['submissionfileid'] : '';
    
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
    
        $files = $_FILES['submissionfile'];
        $success = true;
        $errorMessage = '';
    
        $fileName = basename($files["name"]);
        $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        $allowedFileTypes = array('doc', 'docx');
    
        if (!in_array($imageFileType, $allowedFileTypes)) {
            $success = false;
            $errorMessage .= "File $fileName - Invalid file type ({$imageFileType}); ";
        }
    
        $maxFileSize = 20 * 1024 * 1024;
    
        if ($files["size"] > $maxFileSize) {
            $success = false;
            $errorMessage .= "File $fileName - Size exceeds the maximum allowed size; ";
        }
    
        $newFilePath = $uploadPath . $fileName;
    
        if ($success && move_uploaded_file($files["tmp_name"], $newFilePath)) {
            header('Content-Type: application/json');
            updateSelectedSubmissionFiles($submissionFileId, $fileName);
            echo json_encode(['success' => true, 'submissionfileid' => $submissionFileId]);
        } else {
            $errorMessage = 'File failed to upload. ' . $errorMessage;
            header('Content-Type: application/json');
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
    
?>