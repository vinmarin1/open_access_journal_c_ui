<?php
include 'dbcon.php';
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');

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
            updateCopyeditingRevisionCheckedFiles();
            break;  
        case 'updatecopyeditinguncheckedfile':
            updateCopyeditingUnCheckedFiles();
            updateCopyeditingRevisionUnCheckedFiles();
            break;
        case 'updatecopyeditedcheckedfile':
            updateCopyeditedCheckedFiles();
            break;
        case 'updatecopyediteduncheckedfile':
            updateCopyeditedUnCheckedFiles();
            break;    
        case 'updatesubmissionfile':
            updateSubmissionFiles();
            break; 
        case 'fetchanswer':
            fetchReviewerAnswer();
            break;     
        case 'adddiscussion':
            addDiscussion();
            break; 
        case 'replydiscussion':
            replyDiscussion();
            break; 
        case 'addrevisionfile':
            addRevisionFile();
            break; 
        case 'fetchsubmissiondiscussion':
            fetchSubmissionDiscussion();
            break;
        case 'uploadcopyeditedfile':
            uploadCopyeditedFile();
            break; 
        case 'uploadproductionfile':
            uploadProductionFile();
            break; 
        case 'updatefinalcheckedfile':
            updateProductionCopyeditedCheckedFiles();
            updateProductionCheckedFiles();
            break;
        case 'updatefinaluncheckedfile':
            updateProductionCopyeditedUnCheckedFiles();
            updateProductionUnCheckedFiles();
            break;
        default:
    }


    function updateSubmissionFiles() {
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
        if(empty($_POST['checkedData'])) {
            echo "No checked data received.";
            return;
        }

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

        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     

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
        if(empty($_POST['uncheckedData'])) {
            echo "No unchecked data received.";
            return;
        }

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

        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     

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
        if (!isset($_POST['checkedData']) || empty($_POST['checkedData'])) {
            echo "No checked data received.";
            return;
        }
    
        $articleFilesIds = $_POST['checkedData'];
        $status = 1;
    
        if (!is_array($articleFilesIds)) {
            $articleFilesIds = array($articleFilesIds);
        }
    
        $decodedIds = json_decode($articleFilesIds[0], true);
    
        if (empty($decodedIds)) {
            echo "No data found in checked data.";
            return;
        }
    
        $articleFilesIds = array_column($decodedIds, 'articleFilesId');
    
        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        $placeholders = array();
        foreach ($articleFilesIds as $key => $articleFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $articleFilesId;
            $placeholders[] = $paramName;
        }
    
        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     
    
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
    
    function updateCopyeditingRevisionCheckedFiles() {
        if (!isset($_POST['checkedRevisionData']) || empty($_POST['checkedRevisionData'])) {
            echo "No checked revision data received.";
            return;
        }
    
        $revisionFilesIds = $_POST['checkedRevisionData'];
        $status = 1;
    
        if (!is_array($revisionFilesIds)) {
            $revisionFilesIds = array($revisionFilesIds);
        }
    
        $decodedIds = json_decode($revisionFilesIds[0], true);
    
        if (empty($decodedIds)) {
            echo "No data found in checked revision data.";
            return;
        }
    
        $revisionFilesIds = array_column($decodedIds, 'revisionFilesId');
    
        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        $placeholders = array();
        foreach ($revisionFilesIds as $key => $revisionFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $revisionFilesId;
            $placeholders[] = $paramName;
        }
    
        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     
    
        $query = "UPDATE article_revision_files
                SET copyediting = :status
                WHERE revision_files_id IN ($placeholders)";
    
        $pdo = connect_to_database();
    
        $pdo->beginTransaction();
    
        $stm = $pdo->prepare($query);
    
        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }
    
        $check = $stm->execute();
    
        if ($check !== false) {
            echo "Copyediting Revision Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file copyediting revision data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
    
    function updateCopyeditingUnCheckedFiles() {
        if (!isset($_POST['uncheckedData']) || empty($_POST['uncheckedData'])) {
            echo "No unchecked data received.";
            return;
        }
    
        $articleFilesIds = $_POST['uncheckedData'];
        $status = 0;
    
        if (!is_array($articleFilesIds)) {
            $articleFilesIds = array($articleFilesIds);
        }
    
        $decodedIds = json_decode($articleFilesIds[0], true);
    
        if (empty($decodedIds)) {
            echo "No data found in unchecked data.";
            return;
        }
    
        $articleFilesIds = array_column($decodedIds, 'articleFilesId');
    
        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        $placeholders = array();
        foreach ($articleFilesIds as $key => $articleFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $articleFilesId;
            $placeholders[] = $paramName;
        }
    
        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     
    
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
    
    function updateCopyeditingRevisionUnCheckedFiles() {
        if (!isset($_POST['uncheckedRevisionData']) || empty($_POST['uncheckedRevisionData'])) {
            echo "No unchecked revision data received.";
            return;
        }
    
        $revisionFilesIds = $_POST['uncheckedRevisionData'];
        $status = 0;
    
        if (!is_array($revisionFilesIds)) {
            $revisionFilesIds = array($revisionFilesIds);
        }
    
        $decodedIds = json_decode($revisionFilesIds[0], true);
    
        if (empty($decodedIds)) {
            echo "No data found in unchecked revision data.";
            return;
        }
    
        $revisionFilesIds = array_column($decodedIds, 'revisionFilesId');
    
        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        $placeholders = array();
        foreach ($revisionFilesIds as $key => $revisionFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $revisionFilesId;
            $placeholders[] = $paramName;
        }
    
        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     
    
        $query = "UPDATE article_revision_files
                SET copyediting = :status
                WHERE revision_files_id IN ($placeholders)";
    
        $pdo = connect_to_database();
    
        $pdo->beginTransaction();
    
        $stm = $pdo->prepare($query);
    
        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }
    
        $check = $stm->execute();
    
        if ($check !== false) {
            echo "Copyediting Revision Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file copyediting revision data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
    
    function fetchReviewerAnswer() {
        $reviewer_id = $_POST['reviewer_id'];
        $article_id = $_POST['article_id'];
        $round = $_POST['round'];
    
        $result = execute_query("SELECT * FROM reviewer_answer WHERE article_id = ? AND author_id = ? AND round = ?", [$article_id, $reviewer_id, $round]);
    
        header('Content-Type: application/json');
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'data' => $result]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to fetch reviewer answer data']);
        }
    }

    function addDiscussion() {
        $uploadPath = "../../../Files/discussion-file/";
        $article_id = $_POST['article_id'];
        $fromuser = $_POST['fromuser'];
        $discussion_type = $_POST['discussiontype'];
        $submissionsubject = $_POST['submissionsubject'];
        $submissionmessage = $_POST['submissionmessage'];
        $submissionfiletype = isset($_POST['submissionfiletype']) ? $_POST['submissionfiletype'] : '';
    
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
    
        $files = isset($_FILES['submissionfile']) ? $_FILES['submissionfile'] : '';
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
            $pdo = null;
        }
    }

    function replyDiscussion() {
        $uploadPath = "../../../Files/discussion-file/";
        $fromuser = $_POST['fromuser'];
        $discussion_id = $_POST['discussion_id'];
        $submissionmessage = $_POST['submissionmessage'];
        $submissionfiletype = isset($_POST['submissionfiletype']) ? $_POST['submissionfiletype'] : '';
    
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
    
        $files = isset($_FILES['submissionfile']) ? $_FILES['submissionfile'] : '';
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

                $query = "INSERT INTO discussion_message (discussion_id, fromuser, message, file, file_type) VALUES (?, ?, ?, ?, ?)";
                $result = execute_query($query, [$discussion_id, $fromuser, $submissionmessage, $fileName, $submissionfiletype], true);
                
            if ($result !== false) {
                $pdo->commit();
                echo json_encode(['status' => true, 'message' => 'Record added successfully']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to add discussion message']);
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log('Exception: ' . $e->getMessage());
            echo json_encode(['status' => false, 'message' => 'Failed to add record. Error: ' . $e->getMessage() . $errorMessage]);
        } finally {
            $pdo = null;
        }
    }

    function fetchSubmissionDiscussion() {
        $discussion_id = $_POST['discussion_id'];
    
        $result = execute_query("SELECT * FROM discussion_message WHERE discussion_id = ?", [$discussion_id]);
    
        header('Content-Type: application/json');
    
        if ($result !== false) {
            echo json_encode(['status' => true, 'data' => $result]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to fetch reviewer answer data']);
        }
    }

    function addRevisionFile() {
        $uploadPath = "../../../Files/revision-article/";
        $article_id = $_POST['article_id'];
        $author_id = NULL;  // Change 'Null' to NULL
        $fromuser = $_POST['fromuser'];
        $revisionfiletype = isset($_POST['revisionfiletype']) ? $_POST['revisionfiletype'] : '';
    
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
    
        $files = isset($_FILES['revisionfile']) ? $_FILES['revisionfile'] : '';
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
        
            $query = "INSERT INTO article_revision_files (article_id, author_id, file_type, file_name, fromuser) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            echo($query);
            $result = $stmt->execute([$article_id, $author_id, $revisionfiletype, $fileName, $fromuser]);
        
            if ($result !== false) {
                $pdo->commit();
                echo json_encode(['status' => true, 'message' => 'Record added successfully']);
            } else {
                $errorInfo = $stmt->errorInfo(); // Fetch error details
                echo json_encode(['status' => false, 'message' => 'Failed to add revision file. Error details: ' . json_encode($errorInfo)]);
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log('Exception: ' . $e->getMessage());
            echo json_encode(['status' => false, 'message' => 'Failed to add record. Error: ' . $e->getMessage() . '. Details: ' . $errorMessage]);
        } finally {
            $pdo = null;
        }
    }        
    
    function uploadCopyeditedFile() {
        $uploadPath = "../../../Files/final-file/";
        $fromuser = $_POST['fromuser'];
        $article_id = $_POST['article_id'];
        $status = 1;
        $filefrom = 'Copyedited';
        $copyeditedfiletype = isset($_POST['copyeditedfiletype']) ? $_POST['copyeditedfiletype'] : '';
    
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
    
        $files = isset($_FILES['copyeditedfile']) ? $_FILES['copyeditedfile'] : '';
        $success = true;
        $errorMessage = '';
    
        if (!empty($files['name'])) {
            // File is provided
            $fileName = basename($files["name"]);
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
            $allowedFileTypes = array('doc', 'docx', 'pdf');
    
            if (!in_array($imageFileType, $allowedFileTypes)) {
                $success = false;
                $errorMessage .= "File $fileName - Invalid file type ({$imageFileType}); ";
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

                $query = "INSERT INTO article_final_files (article_id, fromuser, file_name, file_type, filefrom, copyedited) VALUES (?, ?, ?, ?, ?, ?)";
                $result = execute_query($query, [$article_id, $fromuser, $fileName, $copyeditedfiletype, $filefrom, $status], true);
                
            if ($result !== false) {
                $pdo->commit();
                echo json_encode(['status' => true, 'message' => 'Record added successfully']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to upload copyedited file']);
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log('Exception: ' . $e->getMessage());
            echo json_encode(['status' => false, 'message' => 'Failed to add record. Error: ' . $e->getMessage() . $errorMessage]);
        } finally {
            $pdo = null;
        }
    }

    function updateCopyeditedCheckedFiles() {
        if(empty($_POST['checkedCopyeditedData'])) {
            echo "No checked data received.";
            return;
        }

        $copyeditedFilesIds = $_POST['checkedCopyeditedData'];
        $status = 1;
        
        if (!is_array($copyeditedFilesIds)) {
            $copyeditedFilesIds = array($copyeditedFilesIds);
        }

        $decodedIds = json_decode($copyeditedFilesIds[0], true);
        $copyeditedFilesIds = array_column($decodedIds, 'copyeditedFilesId');

        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        foreach ($copyeditedFilesIds as $key => $copyeditedFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $copyeditedFilesId;
            $placeholders[] = $paramName;
        }

        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     

        $query = "UPDATE article_final_files
                SET copyedited = :status
                WHERE final_files_id IN ($placeholders)";

        $pdo = connect_to_database();

        $pdo->beginTransaction();

        $stm = $pdo->prepare($query);

        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }

        $check = $stm->execute();

        if ($check !== false) {
            echo "Copyedited Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file Copyedited data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }

    function updateCopyeditedUnCheckedFiles() {
        if(empty($_POST['uncheckedCopyeditedData'])) {
            echo "No unchecked data received.";
            return;
        }

        $copyeditedFilesIds = $_POST['uncheckedCopyeditedData'];
        $status = 0;
        
        if (!is_array($copyeditedFilesIds)) {
            $copyeditedFilesIds = array($copyeditedFilesIds);
        }

        $decodedIds = json_decode($copyeditedFilesIds[0], true);
        $copyeditedFilesIds = array_column($decodedIds, 'copyeditedFilesId');

        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        foreach ($copyeditedFilesIds as $key => $copyeditedFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $copyeditedFilesId;
            $placeholders[] = $paramName;
        }

        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     

        $query = "UPDATE article_final_files
                SET copyedited = :status
                WHERE final_files_id IN ($placeholders)";

        $pdo = connect_to_database();

        $pdo->beginTransaction();

        $stm = $pdo->prepare($query);

        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }

        $check = $stm->execute();

        if ($check !== false) {
            echo "Copyedited Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file Copyedited data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }

    function uploadProductionFile() {
        $uploadPath = "../../../Files/final-file/";
        $fromuser = $_POST['fromuser'];
        $article_id = $_POST['article_id'];
        $status = 1;
        $filefrom = 'Production';
        $productionfiletype = isset($_POST['productionfiletype']) ? $_POST['productionfiletype'] : '';
    
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
    
        $files = isset($_FILES['productionfile']) ? $_FILES['productionfile'] : '';
        $success = true;
        $errorMessage = '';
    
        if (!empty($files['name'])) {
            // File is provided
            $fileName = basename($files["name"]);
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
            $allowedFileTypes = array('pdf');
    
            if (!in_array($imageFileType, $allowedFileTypes)) {
                $success = false;
                $errorMessage .= "File $fileName - Invalid file type ({$imageFileType}); ";
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

                $query = "INSERT INTO article_final_files (article_id, fromuser, file_name, file_type, filefrom, production) VALUES (?, ?, ?, ?, ?, ?)";
                $result = execute_query($query, [$article_id, $fromuser, $fileName, $productionfiletype, $filefrom, $status], true);
                
            if ($result !== false) {
                $pdo->commit();
                echo json_encode(['status' => true, 'message' => 'Record added successfully']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to upload production file']);
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log('Exception: ' . $e->getMessage());
            echo json_encode(['status' => false, 'message' => 'Failed to add record. Error: ' . $e->getMessage() . $errorMessage]);
        } finally {
            $pdo = null;
        }
    }

    function updateProductionCopyeditedCheckedFiles() {
        if (!isset($_POST['checkedCopyeditedData']) || empty($_POST['checkedCopyeditedData'])) {
            echo "No checked copyedited data received.";
            return;
        }
    
        $copyeditedFilesIds = $_POST['checkedCopyeditedData'];
        $status = 1;
    
        if (!is_array($copyeditedFilesIds)) {
            $copyeditedFilesIds = array($copyeditedFilesIds);
        }
    
        $decodedIds = json_decode($copyeditedFilesIds[0], true);
    
        if (empty($decodedIds)) {
            echo "No data found in checked copyedited data.";
            return;
        }
    
        $copyeditedFilesIds = array_column($decodedIds, 'copyeditedFilesId');
    
        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        $placeholders = array();
        foreach ($copyeditedFilesIds as $key => $copyeditedFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $copyeditedFilesId;
            $placeholders[] = $paramName;
        }
    
        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     
    
        $query = "UPDATE article_final_files
                SET production = :status
                WHERE final_files_id IN ($placeholders)";
    
        $pdo = connect_to_database();
    
        $pdo->beginTransaction();
    
        $stm = $pdo->prepare($query);
    
        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }
    
        $check = $stm->execute();
    
        if ($check !== false) {
            echo "Production Copyedited Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update production copyedited files data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
    
    function updateProductionCheckedFiles() {
        if (!isset($_POST['checkedProductionData']) || empty($_POST['checkedProductionData'])) {
            echo "No checked production data received.";
            return;
        }
    
        $productionFilesIds = $_POST['checkedProductionData'];
        $status = 1;
    
        if (!is_array($productionFilesIds)) {
            $productionFilesIds = array($productionFilesIds);
        }
    
        $decodedIds = json_decode($productionFilesIds[0], true);
    
        if (empty($decodedIds)) {
            echo "No data found in checked production data.";
            return;
        }
    
        $productionFilesIds = array_column($decodedIds, 'productionFilesId');
    
        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        $placeholders = array();
        foreach ($productionFilesIds as $key => $productionFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $productionFilesId;
            $placeholders[] = $paramName;
        }
    
        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     
    
        $query = "UPDATE article_final_files
                SET production = :status
                WHERE final_files_id IN ($placeholders)";
    
        $pdo = connect_to_database();
    
        $pdo->beginTransaction();
    
        $stm = $pdo->prepare($query);
    
        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }
    
        $check = $stm->execute();
    
        if ($check !== false) {
            echo "Production Checked Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update production checked files data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
    
    function updateProductionCopyeditedUnCheckedFiles() {
        if (!isset($_POST['uncheckedCopyeditedData']) || empty($_POST['uncheckedCopyeditedData'])) {
            echo "No unchecked copyedited data received.";
            return;
        }
    
        $copyeditedFilesIds = $_POST['uncheckedCopyeditedData'];
        $status = 0;
    
        if (!is_array($copyeditedFilesIds)) {
            $copyeditedFilesIds = array($copyeditedFilesIds);
        }
    
        $decodedIds = json_decode($copyeditedFilesIds[0], true);
    
        if (empty($decodedIds)) {
            echo "No data found in unchecked copyedited data.";
            return;
        }
    
        $copyeditedFilesIds = array_column($decodedIds, 'copyeditedFilesId');
    
        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        $placeholders = array();
        foreach ($copyeditedFilesIds as $key => $copyeditedFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $copyeditedFilesId;
            $placeholders[] = $paramName;
        }
    
        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     
    
        $query = "UPDATE article_final_files
                SET production = :status
                WHERE final_files_id IN ($placeholders)";
    
        $pdo = connect_to_database();
    
        $pdo->beginTransaction();
    
        $stm = $pdo->prepare($query);
    
        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }
    
        $check = $stm->execute();
    
        if ($check !== false) {
            echo "Production Copyedited Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update production copyedited files data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
    
    function updateProductionUnCheckedFiles() {
        if (!isset($_POST['uncheckedProductionData']) || empty($_POST['uncheckedProductionData'])) {
            echo "No unchecked production data received.";
            return;
        }
    
        $productionFilesIds = $_POST['uncheckedProductionData'];
        $status = 0;
    
        if (!is_array($productionFilesIds)) {
            $productionFilesIds = array($productionFilesIds);
        }
    
        $decodedIds = json_decode($productionFilesIds[0], true);
    
        if (empty($decodedIds)) {
            echo "No data found in unchecked production data.";
            return;
        }
    
        $productionFilesIds = array_column($decodedIds, 'productionFilesId');
    
        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        $placeholders = array();
        foreach ($productionFilesIds as $key => $productionFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $productionFilesId;
            $placeholders[] = $paramName;
        }
    
        if (empty($placeholders)) {
            $placeholders = 0;
        } else {
            $placeholders = implode(',', $placeholders);
        }     
    
        $query = "UPDATE article_final_files
                SET production = :status
                WHERE final_files_id IN ($placeholders)";
    
        $pdo = connect_to_database();
    
        $pdo->beginTransaction();
    
        $stm = $pdo->prepare($query);
    
        // Bind the parameters
        foreach ($params as $paramName => &$paramValue) {
            $stm->bindParam($paramName, $paramValue, PDO::PARAM_INT);
        }
    
        $check = $stm->execute();
    
        if ($check !== false) {
            echo "Production Unchecked Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update production unchecked files data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
    
?>