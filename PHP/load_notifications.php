<?php
require_once 'dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author_id = $_SESSION['id'];

    // Fetch notifications for the current user
    $sqlNotif = "SELECT n.`article_id`, n.`author_id`, n.`admin`, n.`title`, n.`status`, n.`read`, n.`description`, n.`created`, a.`author_id` AS `article_author_id`
                 FROM `notification` n
                 JOIN `article` a ON n.`article_id` = a.`article_id`
                 WHERE n.`author_id` = :author_id AND n.`read_user` = 0 AND n.`admin` = 0
                 ORDER BY n.`created` DESC";
    $params = array(':author_id' => $author_id);
    $notifications = database_run($sqlNotif, $params);

    // Output the notifications in HTML format
    if ($notifications) {
        foreach ($notifications as $notif) {
            // Display each notification item
            $createdTimestamp = strtotime($notif->created);
            $currentTime = time();
            $timeElapsed = $currentTime - $createdTimestamp;
            $elapsedText = formatTimeElapsed($timeElapsed); // Assuming formatTimeElapsed is defined

            // Determine the article link based on conditions
            if ($notif->title === "Send to Review" && $notif->article_author_id !== $author_id) {
                $articleLink = './review-process.php?id=' . $notif->article_id;
            } else {
                $articleLink = './submitted-article.php?id=' . $notif->article_id;
            }

            echo '
            <li style="padding: 8px;
                list-style-type: none;
                font-size: 12px;
                display: block;">
                <p class="d-flex flex-column "> '  . $notif->title . '
                    <span style="
                        margin-top: 15px;
                        margin-bottom: -15px;
                        font-weight: normal;">Title: </p>
                    <a id="inviteMessage" style="text-decoration: none;
                        color: gray;
                        display: block;
                        padding-bottom: 5px;" href="' . $articleLink . '">' . $notif->description . '</a>
                    <span style="font-weight: bold;
                        color: #004e98;">' . $elapsedText . '</span>
                </li>';
        }
    } else {
        echo '<p class="h6" style="color: gray; font-weight: normal; margin-left: 10px" >0 Notification</p>';
    }
} else {
    echo 'Invalid request.';
}
?>
