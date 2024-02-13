<?php
include 'dbcon.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Check if the function is not already defined
if (!function_exists('get_email_content')) {
    function get_email_content($emc) {
        $pdo = connect_to_database();

        if ($pdo) {
            try {
                $query = "SELECT * FROM email_content WHERE id = :emc";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':emc', $emc, PDO::PARAM_INT);
                $stmt->execute();

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
        case 'email':
            sendEmail();
            break;
        case 'assign_reviewer':
            sendEmailAssignReviewer();
            break;
    }

    function sendEmail() {
       $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'qcujournal@gmail.com';
            $mail->Password = 'txtprxrytyqmloth';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $recipients = !empty($_POST['hiddenEmail']) ? explode(', ', $_POST['hiddenEmail']) : ['qcujournal@gmail.com'];

            $mail->setFrom('qcujournal@gmail.com', 'QCU Journal');

            foreach ($recipients as $recipient) {
                $mail->addAddress($recipient);
            }

            $mail->Subject = $_POST['subject'];

            $mail->isHTML(true);

            $body = '';

            $quillContent = json_decode($_POST['quillContentOne'])->ops;

            foreach ($quillContent as $content) {
                $body .= nl2br($content->insert);
            }

            $mail->Body = $body;

            $id = $_POST['id'];
            $round = $_POST['round'];
            $fromuser = $_POST['fromuser'];
            $article_id = $_POST['article_id'];
            $issues_id = $_POST['issues_id'];
            $articleFilesId = $_POST['checkedData'];
            // $articleFilesId1 = $_POST['checkedData1'];
            $revisionFilesId = $_POST['checkedData2'];
            $copyeditedFilesIds = $_POST['checkedData5'];
            if ($mail->send()) {
                echo "Email sent successfully.";
                if ($id == 1) {
                    updateReviewFiles(1, $articleFilesId);
                    updateArticleStatus($article_id, 4);
                    addLogs($article_id, $fromuser, 'Send to Review');
                    echo "<script>alert('Send to review successfully.');</script>"; 
                } elseif ($id == 2) {
                    updateArticleStatus($article_id, 7);
                    addLogs($article_id, $fromuser, 'Decline for Submission');
                    echo "<script>alert('Decline submission successfully.');</script>";
                } elseif ($id == 3) {
                    updateCopyeditingRevisionFiles(1, $revisionFilesId);
                    updateArticleStatus($article_id, 3);
                    addLogs($article_id, $fromuser, 'Send to Copyediting');
                    echo "<script>alert('Send to copyediting successfully.');</script>";
                } elseif ($id == 4) {
                    if ($round == 'Round 2') {
                        updateRound($article_id, 'Round 3');
                        addLogs($article_id, $fromuser, 'Send for Revision Round 3');
                    } else {
                        updateRound($article_id, 'Round 2');
                        addLogs($article_id, $fromuser, 'Send for Revision Round 2');
                    }
                    echo "<script>alert('Request for revision successfully.');</script>";
                } elseif ($id == 5) {
                    updateCopyeditedFiles(1, $copyeditedFilesIds);                
                    updateArticleStatus($article_id, 2);
                    addLogs($article_id, $fromuser, 'Send to Production');
                    echo "<script>alert('Send to production successfully.');</script>";
                } elseif ($id == 6) {
                    updateIssues($article_id, $issues_id);
                    updateArticleStatus($article_id, 11);
                    addLogs($article_id, $fromuser, 'Article send for Scheduled');
                    echo "<script>alert('Send to Scheduled successfully.');</script>";
                } elseif ($id == 7) {
                    updateArticleStatusArchive($article_id, 0);
                    addLogs($article_id, $fromuser, 'Article move to Archive');
                    echo "<script>alert('Article move to archive successfully.');</script>";
                } elseif ($id == 8) {
                    updateArticleStatusPublished($article_id, 1);
                    addLogs($article_id, $fromuser, 'Article Published');
                    echo "<script>alert('Article published successfully.');</script>";
            } else {
                echo 'Error sending email: ' . $mail->ErrorInfo;
            }
        }
        } catch (Exception $e) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }   
    
    function updateArticleStatusArchive($article_id, $status) {
        $query = "UPDATE article 
                  SET status = ?, archive_date = NOW()
                  WHERE article_id = ?";
    
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);
        $check = $stm->execute([$status, $article_id]);
    
        if ($check !== false) {
            echo "<script>alert('Article Status updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update status data');</script>";
        }
    }
    
    function updateArticleStatusPublished($article_id, $status) {
        $query = "UPDATE article 
                  SET status = ?, publication_date = NOW()
                  WHERE article_id = ?";
    
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);
        $check = $stm->execute([$status, $article_id]);
    
        if ($check !== false) {
            echo "<script>alert('Article Status updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update status data');</script>";
        }
    }
    
    function updateArticleStatus($article_id, $status) {
    
        $query = "UPDATE article 
                SET status = ?
                WHERE article_id = ?";
    
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);   
        $check = $stm->execute([$status, $article_id]);
    
        if ($check !== false) {
            echo "<script>alert('Article Status updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update status data');</script>";
        }
    }

    function updateRound($article_id, $round) {
    
        $query = "UPDATE article 
                SET round = ?
                WHERE article_id = ?";
    
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);   
        $check = $stm->execute([$round, $article_id]);
    
        if ($check !== false) {
            echo "<script>alert('Article round updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update round data');</script>";
        }
    }

    function updateIssues($article_id, $issues_id) {
    
        $query = "UPDATE article 
                SET issues_id = ?
                WHERE article_id = ?";
    
        $pdo = connect_to_database();
    
        $stm = $pdo->prepare($query);   
        $check = $stm->execute([$issues_id, $article_id]);
    
        if ($check !== false) {
            echo "<script>alert('Article issues updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update issues data');</script>";
        }
    }

    function updateReviewFiles($status, $articleFilesIds) {
    
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

    function updateCopyeditingFiles($status, $articleFilesIds) {
    
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
            echo "Review Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file review data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }

    function updateCopyeditingRevisionFiles($status, $revisionFilesIds) {
    
        if (!is_array($revisionFilesIds)) {
            $revisionFilesIds = array($revisionFilesIds);
        }
    
        $decodedIds = json_decode($revisionFilesIds[0], true);
        $revisionFilesIds = array_column($decodedIds, 'revisionFilesId');
    
        // Create an array of named parameters for binding
        $params = array(':status' => $status);
        foreach ($revisionFilesIds as $key => $revisionFilesId) {
            $paramName = ":id$key";
            $params[$paramName] = $revisionFilesId;
            $placeholders[] = $paramName;
        }
    
        $placeholders = implode(',', $placeholders);
    
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
            echo "Revision Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file revision data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }
      
    function updateCopyeditedFiles($status, $copyeditedFilesIds) {
    
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
    
        $placeholders = implode(',', $placeholders);
    
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
            echo "Review production Files updated successfully";
            $pdo->commit();
        } else {
            echo "Failed to update file review production data";
            print_r($stm->errorInfo());
            $pdo->rollBack();
        }
    }

    if (!function_exists('get_reviewer_content')) {
        function get_reviewer_content($emc) {
            $pdo = connect_to_database();
    
            if ($pdo) {
                try {
                    $query = "SELECT * FROM email_content WHERE id = :emc";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':emc', $emc, PDO::PARAM_INT);
                    $stmt->execute();
    
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

    function sendEmailAssignReviewer() {
        $mail = new PHPMailer(true);
 
         try {
             // SMTP configuration
             $mail->isSMTP();
             $mail->Host = 'smtp.gmail.com';
             $mail->SMTPAuth = true;
             $mail->Username = 'qcujournal@gmail.com';
             $mail->Password = 'txtprxrytyqmloth';
             $mail->SMTPSecure = 'ssl';
             $mail->Port = 465;

             $mail->addAddress($_POST['revieweremail']);
             $mail->setFrom('qcujournal@gmail.com', 'QCU Journal');
             $mail->Subject = $_POST['subject'];
             $mail->isHTML(true);
             
             $quillContent = json_decode($_POST['quillContentOne'])->ops;
             
             $body = '';
             
             foreach ($quillContent as $content) {
                 if (isset($content->insert)) {
                     $body .= nl2br($content->insert);
                 }
             }
             
             $mail->Body = $body;
 
             $reviewerid = $_POST['reviewerid'];
             $articleid = $_POST['articleid'];
             $round = $_POST['round'];
 
             if ($mail->send()) {
                 echo "Email sent to reviewer successfully.";
                 assignReviewer($articleid, $reviewerid, $round);
             } else {
                 echo 'Error sending email: ' . $mail->ErrorInfo;
             }
         } catch (Exception $e) {
             echo 'Mailer Error: ' . $mail->ErrorInfo;
         }
     }

     function assignReviewer($articleid, $reviewerid, $round) {
        $deadline = date('Y-m-d H:i:s', strtotime('+1 week'));
    
        $query = "INSERT INTO reviewer_assigned (article_id, author_id, round, deadline) VALUES (?, ?, ?, ?)";
        
        $result = execute_query($query, [$articleid, $reviewerid, $round, $deadline], true);
        
        if ($result !== false) {
            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
        } else {

            echo json_encode(['status' => false, 'message' => 'Failed to add record', 'error']);
        }
    }

    function addLogs($articleid, $fromuser, $message) {
  
        $query = "INSERT INTO logs_article (article_id, fromuser, type) VALUES (?, ?, ?)";
        
        $result = execute_query($query, [$articleid, $fromuser, $message], true);
        
        if ($result !== false) {
            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
        } else {
            // $errorInfo = get_db_error_info();
            // echo json_encode(['status' => false, 'message' => 'Failed to add record', 'error' => $errorInfo]);
            echo json_encode(['status' => false, 'message' => 'Failed to add record', 'error']);
        }
    }
    

 

     
?>