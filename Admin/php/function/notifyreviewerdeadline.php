<?php
require_once 'dbcon.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

sendEmailToReviewersWithDeadline();

function sendEmailToReviewersWithDeadline()
{
    $mail = new PHPMailer(true);

    try {
        $pdo = connect_to_database();

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'qcujournal@gmail.com';
        $mail->Password = 'txtprxrytyqmloth';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;


        $stmt = $pdo->prepare("SELECT ra.`reviewer_assigned_id`, ra.`article_id`, ra.`author_id`, ra.`deadline`, a.`title`, a.`abstract`, au.`email`
        FROM `reviewer_assigned` AS ra
        JOIN `article` AS a ON ra.`article_id` = a.`article_id`
        JOIN `author` AS au ON ra.`author_id` = au.`author_id`
        WHERE ra.`deadline` = CURDATE()");

        if ($stmt->rowCount() > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "Author ID with pending deadline: " . $row['author_id'] . "<br>";
            }
        } else {
            echo "No authors have pending deadlines.";
        }

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reviewerEmail = $row['email'];
            $articleTitle = $row['title'];
            $articleAbstract = $row['abstract'];
            $deadline = $row['deadline'];
            $articleId = $row['article_id'];
            $reviewerId = $row['reviewer_assigned_id'];
            $round = $_POST['round'];
            $reviewerURL = "https://qcuj.online/PHP/index.php?urli=https://qcuj.online/PHP/review-process.php?id=" . $articleId;

            $mail->addAddress($reviewerEmail);
            $mail->setFrom('qcujournal@gmail.com', 'QCU Journal');
            $mail->Subject = 'Review Reminder: ' . $articleTitle . ' - Deadline: ' . $deadline;
            $mail->isHTML(true);

            $body = "Dear Reviewer,<br><br>"
            . "This is a reminder that the deadline for reviewing the article titled '{$articleTitle}' is approaching. "
            . "<br><br>Please complete your review by {$deadline}.";

            $body .= "<br><br>You can review the article by clicking on the following link: <a href='" . $reviewerURL . "'>Review Article</a>";
            
            $body .= "<br><br><strong>Title:</strong><br>" . $articleTitle;

            $body .= "<br><br><strong>Abstract:</strong><br>" . $articleAbstract;
            
            $body .= "<br><br>Thank you for your cooperation.<br><br>Best regards,<br>QCU Journal";
      
            $mail->Body = $body;

            if ($mail->send()) {
                echo "Email sent to reviewer with email: $reviewerEmail successfully.<br>";

            } else {
                echo 'Error sending email to reviewer with email: ' . $reviewerEmail . ': ' . $mail->ErrorInfo . '<br>';
            }
            $mail->clearAddresses();
        }
        $pdo = null; // Close the PDO connection
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage() . '<br>';
    }
}
?>
