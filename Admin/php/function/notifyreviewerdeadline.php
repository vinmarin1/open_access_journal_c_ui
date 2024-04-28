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
            $mail->Subject = 'Reminder: Review Deadline Approaching' . $articleTitle . ' - Deadline: ' . $deadline;
            $mail->isHTML(true);

            $body = "Dear Reviewer,<br><br>"
            . "I hope this email finds you well. I am writing to remind you of your commitment to review the manuscript titled '{$articleTitle}' for the Quezon City University Journal."
            . "<br><br>As you may recall, you kindly agreed to provide your expertise and insights on this manuscript within the stipulated review period. However, the deadline for your review is approaching, and we have not yet received your feedback."
            . "<br><br>Your thorough evaluation and constructive feedback are crucial in maintaining the quality and integrity of our peer-review process. Your timely response will greatly assist us in making informed decisions regarding the publication of this manuscript."
            . "<br><br>If you have already begun your review, we sincerely appreciate your efforts and kindly request that you submit your feedback by the agreed-upon deadline. If you require additional time or encounter any difficulties, please do not hesitate to contact us, and we will do our best to accommodate your needs."
            . "<br><br>Your contribution to our journal is invaluable, and we are grateful for your dedication to scholarly peer review. Thank you for your attention to this matter, and we look forward to receiving your feedback soon.."
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
