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
        case 'fetchanswer':
            fetchReviewerAnswer();
            break;     
        case 'addsubmissiondiscussion':
            addSubmissionDiscussion();
            break; 
        // case 'updatecopyeditingchecked1file':
        //     updateCopyeditingChecked1Files();
        //     break; 
    }

    function updateSubmissionFiles() {
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $uploadPath = $documentRoot . '/Files/submitted-article/';
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
            error_log("File path: " . $uploadPath);
            error_log("File permissions: " . decoct(fileperms($uploadPath)));

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

    // function updateCopyeditingChecked1Files() {
    //     $articleFilesIds = $_POST['checkedData1'];
    //     $status = 1;
        
    //     if (!is_array($articleFilesIds)) {
    //         $articleFilesIds = array($articleFilesIds);
    //     }

    //     $decodedIds = json_decode($articleFilesIds[0], true);
    //     $articleFilesIds = array_column($decodedIds, 'articleFilesId');

    //     // Create an array of named parameters for binding
    //     $params = array(':status' => $status);
    //     foreach ($articleFilesIds as $key => $articleFilesId) {
    //         $paramName = ":id$key";
    //         $params[$paramName] = $articleFilesId;
    //         $placeholders[] = $paramName;
    //     }

    //     $placeholders = implode(',', $placeholders);

    //     $query = "UPDATE article_files
    //             SET copyediting = :status
    //             WHERE article_files_id IN ($placeholders)";

    //     $pdo = connect_to_database();

    //     $pdo->beginTransaction();

    //     $stm = $pdo->prepare($query);

    //     // Bind the parameters
    //     foreach ($params as $paramName => &$paramValue) {
    //         $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
    //     }

    //     $check = $stm->execute();

    //     if ($check !== false) {
    //         echo "Copyediting Files updated successfully";
    //         $pdo->commit();
    //     } else {
    //         echo "Failed to update file copyediting data";
    //         print_r($stm->errorInfo());
    //         $pdo->rollBack();
    //     }
    // }
    
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

    function fetchReviewerAnswer() {
        $reviewer_id = $_POST['reviewer_id'];
        $article_id = $_POST['article_id'];
    
        $result = execute_query("SELECT * FROM reviewer_answer WHERE article_id = ? AND author_id = ?", [$article_id, $reviewer_id]);
    
        header('Content-Type: application/json');
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'data' => $result]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to fetch reviewer answer data']);
        }
    }

    function addSubmissionDiscussion() {
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $uploadPath = $documentRoot . '/Files/discussion-file/';
        $article_id = $_POST['article_id'];
        $fromuser = $_POST['fromuser'];
        $discussion_type = "Submission";
        $submissionsubject = $_POST['submissionsubject'];
        $submissionmessage = $_POST['submissionmessage'];
        $submissionfiletype = isset($_POST['submissionfiletype']) ? $_POST['submissionfiletype'] : null;
    
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
    
        $files = isset($_FILES['submissionfile']) ? $_FILES['submissionfile'] : null;
        $success = true;
        $errorMessage = '';
    
        if (!empty($files['name'])) {
            // File is provided
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
                // File is successfully moved to the desired location
            } else {
                $errorMessage .= 'File failed to upload. ';
            }
        }
    
        try {
            $pdo = connect_to_database();
            $pdo->beginTransaction();
    
            $query = "INSERT INTO discussion (article_id, discussion_type, subject) VALUES (?, ?, ?)";
            $newinsert = execute_query($query, [$article_id, $discussion_type, $submissionsubject], true);
    
            if ($newinsert !== false) {

                    $query = "INSERT INTO discussion_message (discussion_id, fromuser, message, file, file_type) VALUES (?, ?, ?, ?, ?)";
                    $result = execute_query($query, [$newinsert, $fromuser, $submissionmessage, $fileName, $submissionfiletype], true);
                    
                if ($result !== false) {
                    $pdo->commit();
                    echo json_encode(['status' => true, 'message' => 'Record added successfully', 'discussion_id' => $newinsert]);
                } else {
                    echo json_encode(['status' => false, 'message' => 'Failed to add discussion message']);
                }
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to add discussion']);
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log('Exception: ' . $e->getMessage());
            echo json_encode(['status' => false, 'message' => 'Failed to add record. Error: ' . $e->getMessage() . $errorMessage]);
        } finally {
            // Close the database connection
            $pdo = null;
        }
    }
    
    
      
?>