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
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'qcujournal@gmail.com';
            $mail->Password = 'txtprxrytyqmloth';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Get recipient emails from the hidden field
            $recipients = explode(', ', $_POST['hiddenEmail']);

            // Email content
            $mail->setFrom('qcujournal@gmail.com', 'QCU Journal');

            // Add multiple recipients
            foreach ($recipients as $recipient) {
                $mail->addAddress($recipient);
            }

            $mail->Subject = $_POST['subject'];

            // You can use either plain text or HTML for the email body
            $mail->isHTML(true);

            // Get the Quill content from the POST data
            $quillContent = json_decode($_POST['quillContentOne'])->ops;

            foreach ($quillContent as $content) {
                // Append the Quill content to the email body
                $body .= nl2br($content->insert);
            }

            $mail->Body = $body;

            $id = $_POST['id'];
            $article_id = $_POST['article_id'];

            // Send email
            if ($mail->send()) {
                echo "Email sent successfully.";
                if ($id == 1) {
                    updateArticleStatus($article_id, 4);
                    echo "<script>alert('Send to review successfully.');</script>";
                } elseif ($id == 2) {
                    updateArticleStatus($article_id, 8);
                    echo "<script>alert('Send to review successfully.');</script>";
                }
            } else {
                echo 'Error sending email: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
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
            echo "<script>alert('Journal data updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update journal data');</script>";
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
 
             if ($mail->send()) {
                 echo "Email sent to reviewer successfully.";
                 assignReviewer($articleid, $reviewerid);
             } else {
                 echo 'Error sending email: ' . $mail->ErrorInfo;
             }
         } catch (Exception $e) {
             echo 'Mailer Error: ' . $mail->ErrorInfo;
         }
     }

     function assignReviewer($articleid, $reviewerid) {
  
        $query = "INSERT INTO reviewer_assigned (article_id, author_id) VALUES (?, ?)";
        
        $result = execute_query($query, [$articleid, $reviewerid], true);
        
        if ($result !== false) {
            echo json_encode(['status' => true, 'message' => 'Record added successfully']);
        } else {
            // $errorInfo = get_db_error_info();
            // echo json_encode(['status' => false, 'message' => 'Failed to add record', 'error' => $errorInfo]);
            echo json_encode(['status' => false, 'message' => 'Failed to add record', 'error']);
        }
    }
    

 

     
?>